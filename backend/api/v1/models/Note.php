<?php

namespace app\api\v1\models;

use Yii;

/**
 * This is the model class for table "{{%note}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @property NoteHistory[] $noteHistories
 */
class Note extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\BlameableBehavior::class,
                'updatedByAttribute' => false,
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'value' => function() { return date('Y-m-d H:i:s', time()); },
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%note}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by'], 'integer'],
            [['title'], 'string', 'max' => 1024],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\app\api\v1\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[NoteHistories]].
     *
     * @return \yii\db\ActiveQuery|\app\api\v1\models\query\NoteHistoryQuery
     */
    public function getNoteHistories()
    {
        return $this->hasMany(NoteHistory::class, ['note_id' => 'id'])->orderBy(['changed_at' => SORT_DESC]);
    }

    /**
     * {@inheritdoc}
     * @return \app\api\v1\models\query\NoteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new \app\api\v1\models\query\NoteQuery(get_called_class()))->forCurrentUser();
    }
}
