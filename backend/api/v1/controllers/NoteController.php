<?php

namespace app\api\v1\controllers;

use yii\rest\ActiveController;

class NoteController extends ActiveController
{
    function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => \yii\filters\auth\HttpBearerAuth::class,
//        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update']);

        $actions['create'] = [
            'class' => 'app\api\v1\actions\CreateNoteAction',
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
            'scenario' => $this->createScenario,
        ];

        $actions['update'] = [
            'class' => 'app\api\v1\actions\UpdateNoteAction',
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
            'scenario' => $this->updateScenario,
        ];

        return $actions;
    }

    public $modelClass = 'app\api\v1\resource\Note';
}