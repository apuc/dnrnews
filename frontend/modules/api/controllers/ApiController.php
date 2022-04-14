<?php

namespace frontend\modules\api\controllers;

use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;
use common\behaviors\GsCors;

class ApiController extends Controller
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'corsFilter' => [
                    'class' => GsCors::class,
                    'cors' => [
                        'Origin' => ['*'],
                        //'Access-Control-Allow-Credentials' => true,
                        'Access-Control-Allow-Headers' => [
                            'Content-Type',
                            'Access-Control-Allow-Headers',
                            'Authorization',
                            'X-Requested-With'
                        ],
                    ]
                ],
            ],
        ]);
    }
}