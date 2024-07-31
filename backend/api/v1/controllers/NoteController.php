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

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'update' || $action === 'delete') {
            if ($model->created_by !== \Yii::$app->user->id) {
                throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s notes that you\'ve created.', $action));
            }
        }
    }

    public $modelClass = 'app\api\v1\resource\Note';
}