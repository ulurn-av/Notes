<?php

namespace app\api\v1\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\api\v1\models
 *
 * @property int $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password_hash
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string {
        return 'user';
    }

    public function rules(): array {
        return [
            [['email', 'first_name', 'last_name', 'password_hash'], 'required'],
            [['email', 'first_name', 'last_name'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['email'], 'email'],
        ];
    }

    public function validatePassword($password): bool {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByEmail($email): ?User {
        return static::findOne(['email' => $email]);
    }

    /**
     * @param $token
     * @param $type
     * @return mixed
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @param $authKey
     * @return mixed
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}