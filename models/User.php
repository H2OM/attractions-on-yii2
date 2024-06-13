<?php

namespace app\models;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use function PHPUnit\Framework\isEmpty;

/**
 * @property string $id
 * @property string $password
 * @property string $username
 * @property string $authKey
 */
class User extends ActiveRecord implements IdentityInterface
{
    public function rules() : array
    {
        return [
            [['username', 'password'], 'required'],
        ];
    }

    /**
     * Сравнение переданного пароля с паролем переданного юзера
     *
     * @return bool
     */
    public function compare() : bool
    {
        $user = static::findBySql("SELECT * FROM " . static::tableName() . " WHERE username = :user_name", [':user_name'=>$this->getUsername()])->one();

        if($user === null) {
            return false;
        }

        if(Yii::$app->getSecurity()->validatePassword($this->getPassword(), $user['password'])) {

            $this->setUsername($user['username']);

            $this->setPassword($user['password']);

            $this->setId($user['id']);

            $this->authKey = $user['authKey'];

            return true;
        } else {
            return false;
        }
    }

    /**
     * @throws Exception
     * @throws \yii\db\Exception
     */
    public function setNewUser() : bool
    {
        $this->setPassword(Yii::$app->getSecurity()->generatePasswordHash($this->getPassword()));

        $this->authKey = Yii::$app->getSecurity()->generateRandomString(64);

        return $this->save();
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
     * @param string $id
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAuthKey() : string
    {
        return $this->authKey;
    }

    /**
     * @param $authKey
     * @return bool
     */
    public function validateAuthKey($authKey) : bool
    {
        return $this->authKey === $authKey;
    }

    /**
     * @param $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id): User|IdentityInterface|null
    {
        return static::findOne(['id'=>$id]);
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
