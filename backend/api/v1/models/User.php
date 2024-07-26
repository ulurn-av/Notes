<?php

namespace app\api\v1\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName(): string {
        return 'user';
    }

    public function rules(): array {
        return [
            [['email', 'first_name', 'last_name', 'hash_password'], 'required'],
            [['email', 'first_name', 'last_name'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['email'], 'email'],
        ];
    }
}