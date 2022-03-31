<?php

namespace common\services;

use frontend\modules\api\models\News;

class NewsService
{
    public static function getNews($category_id = null, array $tags_id = null)
    {

        $query = News::find();
        $query->distinct()
            ->joinWith(['category', 'tags']);

        if (!empty($category_id)) {
            $query->andFilterWhere(['=', 'category.id', $category_id]);
        }

        if (!empty($tags_id)) {
            $query->andFilterWhere(['=', 'tag.id', $tags_id[0]]);
            if (count($tags_id) > 1) {
                for ($i = 1; $i < count($tags_id); ++$i) {
                    $query->orFilterWhere(['=', 'tag.id', $tags_id[$i]]);
                }
            }
        }

        return $query->all();
    }
}