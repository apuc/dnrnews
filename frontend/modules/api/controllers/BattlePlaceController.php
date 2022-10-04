<?php


namespace frontend\modules\api\controllers;


use common\services\ResponseService;
use frontend\modules\api\models\BattlePlace;
use Yii;


class BattlePlaceController extends ApiController
{
    public function verbs(): array
    {
        return [
            'get-bounds' => ['GET'],
        ];
    }

    public function actionGetBattlePlaces(): array
    {
        $colors = BattlePlace::find()->all();

        if (!empty($colors)) {
            $response = ResponseService::successResponse(
                'List of battle places',
                $colors
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                'Battle places not found!'
            );
        }
        return $response;
    }
}
