<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\EventType;
use yii\helpers\ArrayHelper;

class EventTypeController extends ApiController
{
    public $modeClass = EventType::class;

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'getEventTypes' => ['GET'],
                ],
            ]
        ]);
    }

    public function actionGetEventTypes($event_type_id = null): array
    {
        if ($event_type_id) {
            $response = ResponseService::successResponse(
                'One event type.',
                EventType::find()
                    ->where(['id' => $event_type_id])
                    ->andWhere(['status' => EventType::STATUS_ACTIVE])
                    ->one()
            );
        } else {
            $response = ResponseService::successResponse(
                'Event type list.',
                EventType::find()
                    ->where(['status' => EventType::STATUS_ACTIVE])
                    ->all()
            );
        }

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'Event types not exist!'
            );
        }
        return $response;
    }
}