<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Tag;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TagController extends Controller
{
    public $modeClass = Tag::class;

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
    public function actionTag($tag_id = null): array
    {
        $response['isSuccess'] = 200;
        if ($tag_id) {
            $response['tag'] = Tag::findOne($tag_id);
        } else {
            $response['tag'] = Tag::find()->all();
        }

        if (empty($response['tag'])) {
            throw new NotFoundHttpException('The tag not exist!');
        }
        return $response;
    }
}