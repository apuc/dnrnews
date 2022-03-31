<?php

namespace common\services;

use common\models\UserNewsLike;
use yii\db\StaleObjectException;

class NewsLikeService
{
    public static function setLike($news_id, $user_id)
    {
        if (self::likeExist($news_id, $user_id)) {
            return self::findNewsLike($news_id, $user_id);
        }

        $model = new UserNewsLike([
            'news_id' => $news_id,
            'user_id' => $user_id
        ]);

        $model->save();
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public static function deleteLike($news_id, $user_id): ?UserNewsLike
    {
        $model = UserNewsLike::findOne([
            'news_id' => $news_id,
            'user_id' => $user_id
        ]);

        if (empty($model)) {
            return $model;
        }

        $model->delete();
        return $model;
    }

    public static function findNewsLike($news_id, $user_id)
    {
        return UserNewsLike::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['news_id' => $news_id])
            ->one();
    }

    private static function likeExist($news_id, $user_id): bool
    {
        return UserNewsLike::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['news_id' => $news_id])
            ->exists();
    }
}