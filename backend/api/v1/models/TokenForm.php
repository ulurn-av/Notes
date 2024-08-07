<?php

namespace app\api\v1\models;

use app\components\JwtAuth;
use app\components\JwtHelper;
use yii\base\Model;

class TokenForm extends Model
{
    public string $token = '';

    public function rules(): array {
        return [
            ['token', 'required']
        ];
    }

    public function isValidToken(): bool {
        $auth = new JwtAuth();

        $payload = JwtHelper::validateToken($this->token);
        if($payload && isset($payload->sub) && $auth->findIdentity($payload->sub)) {
            return True;
        }
        return False;
    }
}