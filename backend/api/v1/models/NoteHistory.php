<?php

namespace app\api\v1\models;

use Yii;

/**
 * This is the model class for table "{{%note_history}}".
 *
 * @property int $id
 * @property int $note_id
 * @property string $content
 * @property string $changed_at
 *
 * @property Note $note
 */
class NoteHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%note_history}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note_id', 'content', 'changed_at'], 'required'],
            [['note_id'], 'integer'],
            [['content'], 'string'],
            [['changed_at'], 'safe'],
            [['note_id'], 'exist', 'skipOnError' => true, 'targetClass' => Note::class, 'targetAttribute' => ['note_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'note_id' => 'Note ID',
            'content' => 'Content',
            'changed_at' => 'Changed At',
        ];
    }

    /**
     * Gets query for [[Note]].
     *
     * @return \yii\db\ActiveQuery|\app\api\v1\models\query\NoteQuery
     */
    public function getNote()
    {
        return $this->hasOne(Note::class, ['id' => 'note_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\api\v1\models\query\NoteHistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\api\v1\models\query\NoteHistoryQuery(get_called_class());
    }
}
