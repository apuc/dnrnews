<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\LoginForm;
use frontend\modules\api\models\SignupForm;
use frontend\modules\api\models\User;
use Yii;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;

class UserController extends Controller
{
    public $modeClass = User::class;

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'login' => ['GET'],
                    'create' => ['POST'],
//                    'update' => ['PUT', 'POST'],
//                    'delete' => ['POST', 'DELETE'],
                ],
            ],
        ]);
    }


    public function actionLogin(): array
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->get(), '') && $model->login()) {
            $response['isSuccess'] = 200;
            $response['message'] = 'Authorization is successful!';
            $response['user'] = User::findByUsername($model->username);
        } else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
        }
        return $response;
    }

    public function actionCreate(): array
    {
        $model = new SignupForm();
        $params = Yii::$app->request->post();
        $model->username = $params['username'];
        $model->password = $params['password'];
        $model->email = $params['email'];

        if ($model->signup()) {
            $response['isSuccess'] = 201;
            $response['message'] = 'You are now a member!';
            $response['user'] = User::findByUsername($model->username);
        } else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
        }
        return $response;
    }

//    public function actionUpdate()
//    {
//        return User::findOne(1);
//    }
//
//    public function actionDelete()
//    {
//        return User::findOne(1);
//    }
}
