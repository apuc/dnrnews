<?php

namespace common\services;

use frontend\modules\api\models\News;
use yii\db\ActiveQuery;
use yii\db\StaleObjectException;

class NewsService
{
    public static function filter($category, $tags, $published, $from_date, $battle_place_name): ActiveQuery
    {
        $query = News::find()
            ->where(['news.status' => News::STATUS_ACTIVE])
            ->andWhere(['<=','news.published_date', time()])
            ->orderBy('created_at DESC');

        if ($category) {
            $query->joinWith(['categoryNews'])
                ->andWhere(['category_news.category_id' => $category]);
        }

        if ($tags) {
            $query->joinWith(['newsTag'])
                ->andWhere(['news_tag.tag_id' => $tags]);
        }

        if ($published) {
            if (empty($from_date)) {
                $query->andWhere(['like', 'news.created_at', $published]);
            } else {
                $query->andWhere(['between', 'news.created_at', $from_date, $published]);
            }
        }

        if ($battle_place_name) {
            $query->joinWith(['battlePlace'])
                ->andWhere(['battle_place.name' => $battle_place_name]);
        }

        return $query;
    }

    public static function findNews($text): ActiveQuery
    {
        $query = News::find()
            ->orderBy('created_at DESC')
            ->andWhere(['<=','published_date', time()]);

        if (!empty($text)) {
            $query->where(['like', 'title', $text]);
            $query->orWhere(['like', 'news_body', $text]);
        }
        $query->andWhere(['news.status' => News::STATUS_ACTIVE]);

        return $query;
    }

    public static function getNewsList(array $category_id = null, array $tags_id = null): ActiveQuery
    {
        $query = News::find()
            ->where(['news.status' => News::STATUS_ACTIVE])
            ->andWhere(['<=','news.published_date', time()]);

        $query->distinct()
            ->joinWith(['category', 'tags']);

        if ($category_id) {
            $query->andFilterWhere(['=', 'category.id', $category_id[0]]);
            if (count($category_id) > 1) {
                for ($i = 1; $i < count($category_id); ++$i) {
                    $query->orFilterWhere(['=', 'category.id', $category_id[$i]]);
                }
            }
        }

        if ($tags_id) {
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

        if ($news->status != News::STATUS_ACTIVE) {
            return null;
        }
        self::addView($news);
        return $news;
    }

    /**
     * @throws StaleObjectException
     */
    public static function addView(News $news)
    {
        $news->views = $news->views + 1;
        $news->update(false);
    }
}