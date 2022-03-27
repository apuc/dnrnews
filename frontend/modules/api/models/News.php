<?php

namespace frontend\modules\api\models;

use yii\helpers\Url;
use yii\web\Linkable;

class News extends \common\models\News implements Linkable
{
    public function fields()
    {
        return ['id', 'title', 'photo', 'news_body', 'like', 'dislike', ];
    }

    public function extraFields()
    {
        return [
            'tags', 'comments'
        ];
    }

    public function getTags(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->via('newsTags');
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['news_id' => 'id']);
    }

    public function getLinks()
    {
        return [
            'self' => Url::to(['news/news', 'expand' =>'comments',  'news_id' => $this->id], true),
        ];
    }
}
