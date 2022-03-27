<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Category;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CategoryController extends Controller
{
    public $modeClass = Category::class;

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
                    'category' => ['GET'],
                ],
            ],
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionCategory($category_id = null): array
    {
        $response['isSuccess'] = 200;
        if ($category_id) {
            $response['category'] = Category::findOne($category_id);
        } else {
            $response['category'] = Category::find()->all();
        }

        if (empty($response['category'])) {
            throw new NotFoundHttpException('The categories not exist!');
        }
        return $response;
    }
}