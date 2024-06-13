<?php

namespace app\models\Catalog;

use yii\db\ActiveRecord;

/**
 * @property string $image
 * @property string $title
 * @property string $article
 * @property string $city
 * @property string $text
 * @property string|null $id
 */

class Catalog extends ActiveRecord
{
    public function rules() : array
    {
        return [
            [['image', 'title', 'article', 'city', 'text'], 'required']
        ];
    }

    public function setAll(array $values) : void
    {
        foreach (['image', 'title', 'article', 'city', 'text', 'id'] as $key => $value) {

            if (isset($values[$value])) {

                $setter = 'set' . ucfirst($value);

                $this->$setter($values[$value]);
            }
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return void
     */
    public function setId() : void
    {
        $this->id;
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
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return void
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getArticle(): ?string
    {
        return $this->article;
    }

    /**
     * @param string|null $article
     * @return void
     */
    public function setArticle(?string $article): void
    {
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return void
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

}