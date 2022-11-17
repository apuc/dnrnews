<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\LoginForm;
use frontend\modules\api\models\SignupForm;
use frontend\modules\api\models\User;
use Yii;
use yii\helpers\ArrayHelper;

class UserController extends ApiController
{
    public $modeClass = User::class;

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'login' => ['GET'],
                    'create' => ['POST'],
                ],
            ]
        ]);
    }

    public function actionLogin($username, $password): array
    {
        $loginFormModel = new LoginForm();
        if ($loginFormModel->load(Yii::$app->request->get(), '') && $loginFormModel->login()) {
             $response = ResponseService::successResponse(
                'Authorization is successful!',
                User::findByUsername($loginFormModel->username)
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $loginFormModel->getErrors()
            );
        }
        return $response;
    }

    public function actionCreate(): array
    {
        $signupFormModel = new SignupForm();
        $signupFormModel->attributes = Yii::$app->request->post();

        if ($signupFormModel->signup()) {
            $response = ResponseService::successResponse(
                'You are now a member!',
                User::findByUsername($signupFormModel->username)
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $signupFormModel->getErrors()
            );
        }
        return $response;
    }
}
