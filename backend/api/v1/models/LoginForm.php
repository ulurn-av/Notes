<?php

namespace app\api\v1\models;


use yii\base\Model;
use app\api\v1\resource\User;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    private ?User $_user = null;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            [['email'], 'email'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password');
            }
        }
    }

    public function login(): bool {
        if ($this->validate()) {
            return \Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    public function getUser(): ?User {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }
}