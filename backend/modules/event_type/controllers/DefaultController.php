<?php

namespace backend\modules\event_type\controllers;

use yii\web\Controller;

/**
 * Default controller for the `event_type` module
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
