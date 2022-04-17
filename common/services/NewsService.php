<?php

namespace common\services;

use frontend\modules\api\models\News;
use yii\db\ActiveQuery;
use yii\db\StaleObjectException;

class NewsService
{
    public static function findNewsByDate($published, $from_date): ActiveQuery
    {
        $query = News::find();

        if (empty($from_date)) {
            $query->where(['like', 'created_at', $published]);
        } else {
            $query->where(['between', 'created_at', $from_date, $published]);
        }
        return $query;
    }

    public static function findNews($title, $text): ActiveQuery
    {
        $query = News::find();

        if (!empty($title)) {
            $query->filterWhere(['like', 'title', $title]);
        }

        if (!empty($text)) {
            $query->andFilterWhere(['like', 'news_body', $text]);
        }

        return $query;
    }

    public static function getNewsList(array $category_id = null, array $tags_id = null): ActiveQuery
    {
        $query = News::find();
        $query->distinct()
            ->joinWith(['category', 'tags']);

        if (!empty($category_id)) {
            $query->andFilterWhere(['=', 'category.id', $category_id[0]]);
            if (count($category_id) > 1) {
                for ($i = 1; $i < count($category_id); ++$i) {
                    $query->orFilterWhere(['=', 'category.id', $category_id[$i]]);
                }
            }
        }

        if (!empty($tags_id)) {
            $query->andFilterWhere(['=', 'tag.id', $tags_id[0]]);
            if (count($tags_id) > 1) {
                for ($i = 1; $i < count($tags_id); ++$i) {
                    $query->orFilterWhere(['=', 'tag.id', $tags_id[$i]]);
                }
            }
        }

        return $query;
    }

    /**
     * @throws StaleObjectException
     */
    public static function getNews($news_id): ?News
    {
        $news = News::findOne($news_id);
        self::addView($news);
        return $news;
    }

    /**
     * @throws StaleObjectException
     */
    private static function addView(News $news)
    {
        $news->views = $news->views + 1;
        $news->update(false);
    }
}