<?php

namespace app\api\v1\resource;

class Note extends \app\api\v1\models\Note
{
    public function fields()
    {
        return ['id', 'title', 'content', 'created_at', 'updated_at', 'createdBy', 'noteHistories'];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
}