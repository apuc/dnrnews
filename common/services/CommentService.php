<?php


namespace common\services;

use common\models\User;
use common\models\UserCommentDislike;
use common\models\UserCommentLike;
use frontend\modules\api\models\Comment;


class CommentService
{
    public static function commentsNews($request): array
    {
        $news_id = $request->get('news_id');
        $commentsArray = Comment::find()->where(['news_id' => $news_id])->all();

        $user_id = null;
        if ($request->getHeaders()->get('Authorization')) {
            $authHeader = $request->getHeaders()->get('Authorization');
            preg_match('/^Bearer\s+(.*?)$/', $authHeader, $token);
            $user_id = User::find()->where(['access_token' => $token[1]])->select('id')->all();
        }

        if (!empty($user_id)) {
            for ($i = 0; $i < count($commentsArray); ++$i) {
                if (self::hasLike($user_id[0]['id'], $commentsArray[$i]['id'])) {
                    $commentsArray[$i]['user_like'] = true;
                    $commentsArray[$i]['user_dislike'] = false;
                    continue;
                }

                if (self::hasDislike($user_id[0]['id'], $commentsArray[$i]['id'])) {
                    $commentsArray[$i]['user_like'] = false;
                    $commentsArray[$i]['user_dislike'] = true;
                    continue;
                }
                $commentsArray[$i]['user_like'] = false;
                $commentsArray[$i]['user_dislike'] = false;
            }
        }

        return $commentsArray;
    }

    private static function hasLike($user_id, $comment_id): bool
    {
        return UserCommentLike::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['comment_id' => $comment_id])
            ->exists();
    }

    private static function hasDislike($user_id, $comment_id): bool
    {
        return UserCommentDislike::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['comment_id' => $comment_id])
            ->exists();
    }
}