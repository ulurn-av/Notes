<?php

namespace app\api\v1\controllers;

use yii\rest\ActiveController;

class NoteController extends ActiveController
{
    function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBearerAuth::class,
        ];

        return $behaviors;
    }

    public $modelClass = 'app\api\v1\models\Note';
}