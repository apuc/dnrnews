<?php

namespace frontend\modules\api\models;

use yii\helpers\Url;
use yii\web\Linkable;

class News extends \common\models\News implements Linkable
{
    public function fields()
    {
        return ['id', 'title'];
    }

    public function extraFields()
    {
        return [
            'tags', 'comments', 'photo', 'news_body', 'like'
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
        $string = str_replace('+', ',', Url::to(['news/news', 'expand' =>'tags comments photo news_body like',  'news_id' => $this->id], true));

        return [
            'self' => $string,
        ];
    }
}
