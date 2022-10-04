<?php

namespace backend\modules\battle_place\controllers;

use yii\web\Controller;

/**
 * Default controller for the `battle_place` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
