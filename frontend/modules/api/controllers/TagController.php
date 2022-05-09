<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\Tag;
use Yii;

class TagController extends ApiController
{
    public $modeClass = Tag::class;

    public function verbs(): array
    {
        return [
            'tag' => ['GET'],
        ];
    }

    public function actionTag($tag_id = null): array
    {
        if ($tag_id) {
            $response = ResponseService::successResponse(
                'One tag.',
                Tag::find()
                    ->where(['id' => $tag_id])
                    ->andWhere(['status' => Tag::STATUS_ACTIVE])
                    ->one()
            );
        } else {
            $response = ResponseService::successResponse(
                'Tag list.',
                Tag::find()
                    ->where(['status' => Tag::STATUS_ACTIVE])
                    ->all()
            );
        }

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The tag not exist!'
            );
        }
        return $response;
    }
}