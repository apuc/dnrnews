<?php

namespace frontend\modules\api\models;

use common\models\EventType;
use yii\db\ActiveQuery;
use yii\helpers\Url;
use yii\web\Linkable;

class News extends \common\models\News implements Linkable
{
    public function fields()
    {
        return [
            'id',
            'title',
            'published_date' => function () {
                return $this->created_at;
            },
            'views',
            'coordinates',
            'event',
            'is_map_event',
        ];
    }

    public function extraFields()
    {
        return [
            'tags',
            'comments',
            'comments_count' => function () {
                return (int)$this->getCommentsCount();
            },
            'photo' => function () {
                return $this->getPhotoLink();
            },
            'news_body',
            'like' => function () {
                return (int)$this->getLikesCount();
            },
            'category' => function () {
                return $this->category;
            },
        ];
    }

    public function getPhotoLink()
    {
        if (empty($this->photo)) {
            return 'N/A';
        }
        return '/uploads/news-image/' . $this->photo;
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->via('newsTags');
    }

    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->via('categoryNews');
    }

    public function getComments(): ActiveQuery
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

    public function getEvent()
    {
        return $this->hasOne(EventType::class, ['id' => 'event_type_id']);
    }
}
