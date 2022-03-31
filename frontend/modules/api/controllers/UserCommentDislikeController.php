<?php

namespace frontend\modules\api\controllers;

use common\services\CommentLikeDislikeService;
use Yii;
use yii\web\ServerErrorHttpException;

class UserCommentDislikeController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\UserCommentDislike';

    public function verbs(): array
    {
        return [
            'comment-set-dislike' => ['POST'],
            'comment-delete-dislike' => ['DELETE']
        ];
    }

    /**
     * @throws ServerErrorHttpException
     */
    public function actionCommentSetDislike()
    {
        $userCommentDislikeModel = CommentLikeDislikeService::commentSetDislike(
            Yii::$app->request->getBodyParam('comment_id'),
            Yii::$app->user->identity->id
        );

        if ($userCommentDislikeModel->hasErrors()) {
            $response['hasErrors'] = $userCommentDislikeModel->hasErrors();
            $response['errors'] = $userCommentDislikeModel->errors;
            return $response;
        }

        $response['isSuccess'] = 200;
        $response['message'] = 'Like is created!';
        $response['user_news_like'] = $userCommentDislikeModel;

        return $response;
    }

    public function actionCommentDeleteDislike($comment_id)
    {
        $userCommentDislikeModel = CommentLikeDislikeService::commentDeleteDislike(
            $comment_id,
            Yii::$app->user->identity->id
        );

        if (empty($userCommentDislikeModel)) {
            $response['hasErrors'] = true;
            $response['errors'] = 'Models not found.';

        } else {
            $response['isSuccess'] = 200;
            $response['message'] = 'Like is deleted!';
            $response['user_news_like'] = $userCommentDislikeModel;
        }
        return $response;
    }
}
