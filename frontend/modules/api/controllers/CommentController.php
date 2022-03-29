<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Comment;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\rest\Controller;

class CommentController extends Controller
{
    public $modelClass = 'frontend\modules\api\models\Comment';

//    public $serializer = [
//        'class' => 'yii\rest\Serializer',
//        'collectionEnvelope' => null,
//    ];

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
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'comment' => ['GET'],
                    'news-comments' => ['GET'],
                    'create' => ['POST'],
                    'delete' => ['DELETE'],
                ],
            ],
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionComment($comment_id): array
    {
        $response['isSuccess'] = 200;
        $response['comment'] = Comment::findOne($comment_id);

        if (empty($response['comment'])) {
            throw new NotFoundHttpException('The comment not exist!');
        }
        return $response;
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionNewsComments($news_id): array
    {
        $response['isSuccess'] = 200;
        $response['comment'] = Comment::find()->where(['news_id' => $news_id])->all();

        if (empty($response['comment'])) {
            throw new NotFoundHttpException('The comments not exist!');
        }
        return $response;
    }

    public function actionCreate()
    {
        $model = new Comment();
        $model->user_id = \Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            $response['isSuccess'] = 200;
            $response['message'] = 'Comment is created!';
            $response['comment'] = $model;
        } else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->errors;
        }
        return $response;
    }

    public function actionDelete($comment_id)
    {
        $response['isSuccess'] = 200;
        $comment = Comment::findOne($comment_id);
        $response['message'] = 'Comment was deleted!';
        $response['comment'] = $comment;
        $comment->delete();

        return $response;
    }
}