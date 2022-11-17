<?php

namespace frontend\modules\api\controllers;

use common\services\CommentLikeDislikeService;
use common\services\ResponseService;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class UserCommentDislikeController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\UserCommentDislike';

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'comment-set-dislike' => ['POST'],
                    'comment-delete-dislike' => ['DELETE']
                ],
            ]
        ]);
    }

    /**
     * @throws StaleObjectException
     */
    public function actionCommentSetDislike(): array
    {
        $userCommentDislikeModel = CommentLikeDislikeService::commentSetDislike(
            Yii::$app->request->getBodyParam('comment_id'),
            Yii::$app->user->identity->id
        );

        if ($userCommentDislikeModel->hasErrors()) {
            return ResponseService::errorResponse(
                $userCommentDislikeModel->errors
            );
        }

        return ResponseService::successResponse(
            'Dislike is created!',
            $userCommentDislikeModel
        );
    }

    /**
     * @throws StaleObjectException
     */
    public function actionCommentDeleteDislike($comment_id): array
    {
        $userCommentDislikeModel = CommentLikeDislikeService::commentDeleteDislike(
            $comment_id,
            Yii::$app->user->identity->id
        );

        if (empty($userCommentDislikeModel)) {
            return ResponseService::errorResponse(
                'Dislike not found.'
            );
        } else {
            return ResponseService::successResponse(
                'Dislike is deleted!',
                $userCommentDislikeModel
            );
        }
    }
}
