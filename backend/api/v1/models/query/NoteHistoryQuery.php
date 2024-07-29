<?php

namespace app\api\v1\models\query;

/**
 * This is the ActiveQuery class for [[\app\api\v1\models\NoteHistory]].
 *
 * @see \app\api\v1\models\NoteHistory
 */
class NoteHistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\api\v1\models\NoteHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\api\v1\models\NoteHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
