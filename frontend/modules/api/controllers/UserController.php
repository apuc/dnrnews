<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\User;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        return 'Test OK';
    }
    public $modeClass = User::class;

    public function actionGetUser()
    {
        return User::findOne(1);
    }
}
