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
            'tags',
            'comments',
            'comments_count' => function () {
                return $this->getCommentsCount();
            },
            'photo',
            'news_body',
            'like' => function () {
                return $this->getLikesCount();
            },
            'category' => function () {
                return $this->category;
            },
        ];
    }

    public function getTags(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->via('newsTags');
    }

    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->via('categoryNews');
    }

    public function getComments(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Comment::className(), ['news_id' => 'id']);
    }

    public function getLinks(): array
    {
        $string = str_replace('+', ',', Url::to(['news/news', 'expand' => 'tags comments photo news_body like', 'news_id' => $this->id], true));

        return [
            'self' => $string,
        ];
    }
}
