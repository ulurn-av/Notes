<?php

namespace app\api\v1\models;

use yii\base\Model;
use yii\db\Exception;

class SignupForm extends Model
{
    public string $email;
    public string $first_name;
    public string $last_name;
    public string $password;

    public function rules(): array
    {
        return [
            [['email', 'first_name', 'last_name', 'password'], 'required'],
            [['email', 'first_name', 'last_name'], 'string', 'max' => 32],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 8],
        ];
    }

    public function signup(): bool {
        if ($this->validate()){
            $user = new User();
            $user->email = $this->email;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->setPassword($this->password);
            try{
                if ($user->save()){
                    return true;
                }
            }
            catch (Exception $e){
                $this->addError('signup', 'User save failed'.$e->getMessage());
            }
        }
        return false;
    }
}