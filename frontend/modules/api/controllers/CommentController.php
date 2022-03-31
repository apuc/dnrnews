<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\Comment;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class CommentController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\Comment';

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
                'only' => ['create', 'delete'],
            ],
        ]);
    }

    public function verbs(): array
    {
        return [
            'comment' => ['GET'],
            'news-comments' => ['GET'],
            'create' => ['POST'],
            'delete' => ['DELETE'], 'category' => ['GET'],
        ];
    }

    public function actionComment($comment_id): array
    {
        $response = ResponseService::successResponse(
            'One comment.',
            Comment::findOne($comment_id)
        );

        if (empty($response['model'])) {
            Yii::$app->response->statusCode = 404;
            $response = ResponseService::errorResponse(
                'The comment not exist!'
            );
        }
        return $response;
    }

    public function actionNewsComments($news_id): array
    {
        $response = ResponseService::successResponse(
            'Comment list for news.',
            Comment::find()->where(['news_id' => $news_id])->all()
        );

        if (empty($response['model'])) {
            Yii::$app->response->statusCode = 404;
            $response = ResponseService::errorResponse(
                'The comment not exist!'
            );
        }
        return $response;
    }

    public function actionCreate(): array
    {
        $commentModel = new Comment();
        $commentModel->user_id = \Yii::$app->user->identity->id;

        if ($commentModel->load(Yii::$app->request->post(), '') && $commentModel->save()) {
            $response = ResponseService::successResponse(
                'Comment is created!',
                $commentModel
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $commentModel->getErrors()
            );
        }
        return $response;
    }

    public function actionDelete($comment_id)
    {
        if (Comment::find()->where(['id' => $comment_id])->exists()) {
            $comment = Comment::findOne($comment_id);
            $comment->delete();
            $response = ResponseService::successResponse(
                'Comment was deleted!',
                $comment
            );
        } else {
            Yii::$app->response->statusCode = 404;
            $response = ResponseService::errorResponse(
                'Comment not found!'
            );
        }
        return $response;
    }
}