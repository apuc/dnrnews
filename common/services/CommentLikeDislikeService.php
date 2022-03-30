<?php

namespace common\services;

use common\models\UserCommentDislike;
use common\models\UserCommentLike;
use yii\db\StaleObjectException;

class CommentLikeDislikeService
{
    /**
     * @throws StaleObjectException
     */
    public static function commentSetLike($comment_id, $user_id): ?UserCommentLike
    {
        if (self::likeExist($comment_id, $user_id)) {
            return self::findUserCommentLike($comment_id, $user_id);
        }

        $model = new UserCommentLike([
            'comment_id' => $comment_id,
            'user_id' => $user_id
        ]);

        if ($model->save()) {
            if (self::dislikeExist($comment_id, $user_id)) {
                self::deleteDislike($comment_id, $user_id);
            }
        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public static function commentDeleteLike($comment_id, $user_id): ?UserCommentLike
    {
        $model = UserCommentLike::findOne([
            'comment_id' => $comment_id,
            'user_id' => $user_id
        ]);

        if (empty($model)) {
            return $model;
        }

        $model->delete();
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public static function commentSetDislike($comment_id, $user_id): ?UserCommentDislike
    {
        if (self::dislikeExist($comment_id, $user_id)) {
            return self::findUserCommentDislike($comment_id, $user_id);
        }

        $model = new UserCommentDislike([
            'comment_id' => $comment_id,
            'user_id' => $user_id
        ]);

        if ($model->save()) {
            if (self::likeExist($comment_id, $user_id)) {
                self::deleteLike($comment_id, $user_id);
            }
        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public static function commentDeleteDislike($comment_id, $user_id): ?UserCommentDislike
    {
        $model = UserCommentDislike::findOne([
            'comment_id' => $comment_id,
            'user_id' => $user_id
        ]);

        if (empty($model)) {
            return $model;
        }

        $model->delete();
        return $model;
    }

    private static function likeExist($comment_id, $user_id): bool
    {
        return UserCommentLike::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['comment_id' => $comment_id])
            ->exists();
    }

    private static function dislikeExist($comment_id, $user_id): bool
    {
        return UserCommentDislike::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['comment_id' => $comment_id])
            ->exists();
    }

    private static function findUserCommentLike($comment_id, $user_id): ?UserCommentLike
    {
        return UserCommentLike::findOne([
            'user_id' => $user_id, 'comment_id' => $comment_id
        ]);
    }

    private static function findUserCommentDislike($comment_id, $user_id): ?UserCommentDislike
    {
        return UserCommentDislike::findOne([
            'user_id' => $user_id, 'comment_id' => $comment_id
        ]);
    }

    /**
     * @throws StaleObjectException
     */
    private static function deleteDislike($comment_id, $user_id)
    {
        $model = UserCommentDislike::findOne([
            'comment_id' => $comment_id,
            'user_id' => $user_id
        ]);
        $model->delete();
    }

    /**
     * @throws StaleObjectException
     */
    private static function deleteLike($comment_id, $user_id)
    {
        $model = UserCommentLike::findOne([
            'comment_id' => $comment_id,
            'user_id' => $user_id
        ]);
        $model->delete();
    }
}