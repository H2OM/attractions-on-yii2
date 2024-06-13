<?php

namespace app\models;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property string $password
 * @property string $username
 * @property mixed|null $auth_key
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 10;

    public function rules() : array
    {
        return [
            [['login', 'password'], 'required'],
        ];
    }

    public function compare() : bool
    {
        $password = static::findBySql("SELECT password FROM " . static::tableName() . " WHERE :user_name", [':user_name'=>$this->getUsername()]);

        if($password === null) {
            return false;
        }

        return Yii::$app->security->validatePassword($this->getPassword(), $password);
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $username
     * @return void
     */
    public function setUsername(string $username) : void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }
    public function validateAuthKey($authKey): ?bool
    {
        return $this->getAuthKey() === $authKey;
    }
    public static function findIdentity($id): User|IdentityInterface|null
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

}
