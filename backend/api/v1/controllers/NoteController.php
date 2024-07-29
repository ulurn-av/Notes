<?php

namespace app\api\v1\controllers;

use yii\rest\ActiveController;

class NoteController extends ActiveController
{
    public $modelClass = 'app\api\v1\models\Note';
}