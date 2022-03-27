<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\News;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\rest\Controller;

class NewsController extends Controller
{
    public $modelClass  = 'frontend\modules\api\models\News';//News::class;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => null,
    ];

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
                    'news' => ['GET'],
                ],
            ],
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionNews($news_id = null): array
    {

        $response['isSuccess'] = 200;
        if ($news_id) {
            $response['news'] = News::findOne($news_id);
        } else {
            $response['news'] = News::find()->all();
        }

        if (empty($response['news'])) {
            throw new NotFoundHttpException('The categories not exist!');
        }
        return $response;
    }
}