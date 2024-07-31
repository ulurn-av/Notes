<?php

namespace app\api\v1\actions;

use app\api\v1\models\NoteHistory;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class UpdateNoteAction extends Action
{
    /**
     * @var string the scenario to be assigned to the model before it is validated and updated.
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * Updates an existing model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being updated
     * @throws ServerErrorHttpException if there is any error when updating the model
     */
    public function run($id)
    {
        /* @var $model ActiveRecord */
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $model->scenario = $this->scenario;
        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        $noteHistory = new NoteHistory();
        $noteHistory->note_id = $model->id;
        $noteHistory->content = $model->content;
        $noteHistory->changed_at = date('Y-m-d H:i:s', time());
        if (!$noteHistory->save()) {
            $model->delete();
            throw new ServerErrorHttpException('Failed to create the NoteHistory record for unknown reason.');
        }

        return $model;
    }
}