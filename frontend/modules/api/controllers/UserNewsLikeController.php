<?php

namespace frontend\modules\api\controllers;

use common\services\NewsLikeService;
use common\services\ResponseService;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class UserNewsLikeController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\UserNewsLike';

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
            ],
        ]);
    }

    public function verbs(): array
    {
        return [
            'set-like' => ['POST'],
            'delete-like' => ['DELETE'],
            'check-news-like' => ['GET'],
        ];
    }

    public function actionSetLike(): array
    {
        $newsLike = NewsLikeService::setLike(
            Yii::$app->request->post('news_id'),
            Yii::$app->user->identity->id
        );

        if ($newsLike->hasErrors()) {
            Yii::$app->response->statusCode = 400;
            return ResponseService::errorResponse(
                $newsLike->errors
            );
        } else {
            return ResponseService::successResponse(
                'Like is already created!',
                $newsLike
            );
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function actionDeleteLike($news_id): array
    {
        $userNewsLikeModel = NewsLikeService::deleteLike(
            $news_id,
            Yii::$app->user->identity->id
        );

        if (empty($userNewsLikeModel)) {
            Yii::$app->response->statusCode = 400;
            return ResponseService::errorResponse(
                'Like not found.'
            );
        } else {
            return ResponseService::successResponse(
                'Like is deleted!',
                $userNewsLikeModel
            );
        }
    }

    public function actionCheckNewsLike($news_id): array
    {
        $model = NewsLikeService::findNewsLike(
            $news_id,
            Yii::$app->user->identity->id
        );

        if (!empty($model)) {
            return ResponseService::successResponse(
                'Like is already existing.',
                $model
            );
        } else {
            Yii::$app->response->statusCode = 404;
            return ResponseService::errorResponse(
                'Like not found.'
            );
        }
    }
}