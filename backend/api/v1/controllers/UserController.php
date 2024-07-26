<?php

namespace app\api\v1\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\api\v1\models\User';
}
