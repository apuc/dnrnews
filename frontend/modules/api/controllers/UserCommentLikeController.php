<?php

namespace frontend\modules\api\controllers;

use common\services\CommentLikeDislikeService;
use Yii;
use yii\web\ServerErrorHttpException;

class UserCommentLikeController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\UserCommentLike';

    public function verbs(): array
    {
        return [
            'comment-set-like' => ['POST'],
            'comment-delete-like' => ['DELETE']
        ];
    }

    /**
     * @throws ServerErrorHttpException
     */
    public function actionCommentSetLike()
    {
        $userCommentLikeModel = CommentLikeDislikeService::commentSetLike(
            Yii::$app->request->getBodyParam('comment_id'),
            Yii::$app->user->identity->id
        );

        if ($userCommentLikeModel->hasErrors()) {
            $response['hasErrors'] = $userCommentLikeModel->hasErrors();
            $response['errors'] = $userCommentLikeModel->errors;
            return $response;
        }

        $response['isSuccess'] = 200;
        $response['message'] = 'Like is created!';
        $response['user_news_like'] = $userCommentLikeModel;

        return $response;
    }

    public function actionCommentDeleteLike($comment_id)
    {
        $userCommentLikeModel = CommentLikeDislikeService::commentDeleteLike(
            $comment_id,
            Yii::$app->user->identity->id
        );

        if (empty($userCommentLikeModel)) {
            $response['hasErrors'] = true;
            $response['errors'] = 'Models not found.';

        } else {
            $response['isSuccess'] = 200;
            $response['message'] = 'Like is deleted!';
            $response['user_news_like'] = $userCommentLikeModel;
        }
        return $response;
    }
}
