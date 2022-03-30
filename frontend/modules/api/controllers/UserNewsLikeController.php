<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\UserNewsLike;
use Yii;

class UserNewsLikeController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\UserNewsLike';

    public function verbs(): array
    {
        return [
            'set-like' => ['POST'],
            'delete-like' => ['DELETE']
        ];
    }

    public function actionSetLike()
    {
        $model = new UserNewsLike();
        $model->user_id = \Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            $response['isSuccess'] = 200;
            $response['message'] = 'Like is created!';
            $response['user_news_like'] = $model;
        } else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->errors;
        }
        return $response;
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteLike($news_id)
    {
        $user_id = \Yii::$app->user->identity->id;

        $model = UserNewsLike::find()->where(['user_id' => $user_id])->andWhere(['news_id' => $news_id])->one();

        if (!empty($model) && $model->delete()) {
            $response['isSuccess'] = 200;
            $response['message'] = 'Like is deleted!';
            $response['user_news_like'] = $model;
        } else {
            $response['Not found error'] = 404;
            $response['message'] = 'Not found!';
        }
        return $response;
    }

    public function actionCheckNewsLike($news_id)
    {
        $user_id = \Yii::$app->user->identity->id;

        $model = UserNewsLike::find()->where(['user_id' => $user_id])->andWhere(['news_id' => $news_id])->one();

        if (!empty($model)) {
            $response['isSuccess'] = 200;
            $response['message'] = 'Like is already existing!';
            $response['user_news_like'] = $model;
        } else {
            $response['Not found error'] = 404;
            $response['message'] = 'Not found!';
        }
        return $response;
    }
}