<?php

namespace app\components;

use app\components\JwtHelper;
use yii\web\user as BaseUser;

class JwtAuth extends BaseUser
{
    public $enableSession = false;

    public function __construct($config = [])
    {
        $this->identityClass = 'app\api\v1\models\User';
        parent::__construct($config);
    }

    public function findIdentity($id)
    {
        return call_user_func([$this->identityClass, 'findIdentity'], $id);
    }

    public function loginByAccessToken($token, $type = null)
    {
        $payload = JwtHelper::validateToken($token);
        if ($payload && isset($payload->sub)) {
            return $this->login($this->findIdentity($payload->sub));
        }
    }
}