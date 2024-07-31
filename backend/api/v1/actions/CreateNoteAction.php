<?php

namespace app\api\v1\actions;

use app\api\v1\models\NoteHistory;
use yii\base\Model;
use yii\helpers\Url;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class CreateNoteAction extends Action
{
    public $scenario = Model::SCENARIO_DEFAULT;
    public $viewAction = 'view';

    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', $model->getPrimaryKey(true));
            $response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));

            $noteHistory = new NoteHistory();
            $noteHistory->note_id = $model->id;
            $noteHistory->content = $model->content;
            $noteHistory->changed_at = date('Y-m-d H:i:s', time());
            if (!$noteHistory->save()) {
                $model->delete();
                throw new ServerErrorHttpException('Failed to create the NoteHistory record for unknown reason.');
            }
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }
}