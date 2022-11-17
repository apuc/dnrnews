<?php

namespace frontend\modules\api\controllers;

use common\services\CommentService;
use common\services\ResponseService;
use frontend\modules\api\models\Comment;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class CommentController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\Comment';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'comments',

    ];

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
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'comment' => ['GET'],
                    'news-comments' => ['GET'],
                    'create' => ['POST'],
                    'delete' => ['DELETE'], 'category' => ['GET'],
                ],
            ]
        ]);
    }

    public function actionComment($comment_id): array
    {
        $response = ResponseService::successResponse(
            'One comment.',
            Comment::find()
                ->where(['id' => $comment_id])
                ->andWhere(['status' => Comment::STATUS_ACTIVE])
                ->one()
        );

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The comment not exist!'
            );
        }
        return $response;
    }

    public function actionNewsComments($news_id)//: array
    {
        return new ActiveDataProvider([
            'query' => CommentService::commentsNews(Yii::$app->request),
        ]);

//        $newsComment = CommentService::commentsNews(Yii::$app->request);
//
//        $response = ResponseService::successResponse(
//            'Comment list for news.',
//            $newsComment
//        );
//
//        if (empty($response['data'])) {
//            $response = ResponseService::errorResponse(
//                'The comment not exist!'
//            );
//        }
//        return $response;
    }

    public function actionCreate(): array
    {
        $commentModel = new Comment();
        $commentModel->user_id = Yii::$app->user->identity->id;

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
            $response = ResponseService::errorResponse(
                'Comment not found!'
            );
        }
        return $response;
    }
}