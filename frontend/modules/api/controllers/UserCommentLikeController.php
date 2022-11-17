<?php

namespace frontend\modules\api\controllers;

use common\services\CommentLikeDislikeService;
use common\services\ResponseService;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class UserCommentLikeController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\UserCommentLike';

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
                    'comment-set-like' => ['POST'],
                    'comment-delete-like' => ['DELETE']
                ],
            ]
        ]);
    }

    /**
     * @throws StaleObjectException
     */
    public function actionCommentSetLike(): array
    {
        $userCommentLikeModel = CommentLikeDislikeService::commentSetLike(
            Yii::$app->request->getBodyParam('comment_id'),
            Yii::$app->user->identity->id
        );

        if ($userCommentLikeModel->hasErrors()) {
            Yii::$app->response->statusCode = 400;
            return ResponseService::errorResponse(
                $userCommentLikeModel->errors
            );
        } else {
            return ResponseService::successResponse(
                'Like is created!',
                $userCommentLikeModel
            );
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function actionCommentDeleteLike($comment_id): array
    {
        $userCommentLikeModel = CommentLikeDislikeService::commentDeleteLike(
            $comment_id,
            Yii::$app->user->identity->id
        );

        if (empty($userCommentLikeModel)) {
            return ResponseService::errorResponse(
                'Like not found.'
            );
        } else {
            return ResponseService::successResponse(
                'Like is deleted!',
                $userCommentLikeModel
            );
        }
    }
}
