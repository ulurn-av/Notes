<?php

namespace app\api\v1\resource;

use app\api\v1\models\User as BaseUser;

class User extends BaseUser
{
    public function fields()
    {
        return ['email'];
    }
}