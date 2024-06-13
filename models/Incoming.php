<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\View;


/**
 * @property string $name
 * @property string $mail
 * @property string|null $number
 * @property string $text
 */

class Incoming extends ActiveRecord
{
//    public $name;
//    public $mail;
//    public $number;
//    public $text;

    public function rules() : array
    {
        //Yii::$app->request->post()) && $model->validate()
//        var_dump(Yii::$app->request->post());
        return [
            [['name', 'mail', 'text'], 'required'],
            ['mail', 'email'],
            [['name'], 'string', 'max'=>60, 'min'=>3],
            [['text'], 'string', 'max'=>1200, 'min'=>10],
            [['number'], 'default'],
        ];
    }

    public function setAll(array $values) : void
    {
        foreach (['name', 'mail', 'number', 'text'] as $key => $value) {

            if (isset($values[$value])) {

                $setter = 'set' . ucfirst($value);

                $this->$setter($values[$value]);
            }
        }
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        if(strlen($number) !== 10) {

            $number = null;

        } else {

            $this->number = $number;
        }
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }
}