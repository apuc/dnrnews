<?php


namespace frontend\modules\api\controllers;


use common\services\ResponseService;
use frontend\modules\api\models\Color;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;


class ColorController extends ApiController
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
                'only' => ['set-color', 'set-colors'],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'get-color' => ['GET'],
                    'set-color' => ['POST'],
                    'set-colors' => ['POST'],
                ],
            ]
        ]);
    }

    public function actionSetColor(): array
    {
        $id = Yii::$app->request->post('id');
        $value = Yii::$app->request->post('value');
        $name = Yii::$app->request->post('name');

        if (!empty(Color::findOne($id))) {
            $colorModel = Color::findOne($id);
        } else {
            $colorModel = new Color();
        }

        if (!empty($name)) {
            $colorModel->name = $name;
        }

        $colorModel->value = $value;
        if ($colorModel->save()) {
            $response = ResponseService::successResponse(
                'Color is saved!',
                $colorModel
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                $colorModel->getErrors()
            );
        }

        return $response;
    }

    public function actionSetColors()
    {
        $colors = Yii::$app->request->post('colors');

        $ids = ArrayHelper::getColumn($colors, 'id');
        $savedColorIDs = ArrayHelper::getColumn(Color::find()->select(['id'])->all(), 'id');

        $deletedIds = array_diff($savedColorIDs, $ids);

        foreach ($deletedIds as $id){
            $model = Color::findOne($id);
            $model->delete();
        }

        if (!empty($colors)) {
            foreach ($colors as $color) {

                if (!empty($color['id'])) {

                    $savedColors = Color::findOne($color['id']);
                    if (!empty($savedColors)) {
                        if ($color['value'] != $savedColors->value) {
                            $savedColors->value = $color['value'];
                            $savedColors->update();
                        } elseif ($color['name'] != $savedColors->name) {
                            $savedColors->name = $color['name'];
                            $savedColors->update();
                        }
                    } else {
                        Yii::$app->response->statusCode = 400;
                        return ResponseService::errorResponse(
                            'Not found color with this id.'
                        );
                    }
                } else {
                    $colorModel = new Color();
                    $colorModel->name = $color['name'];
                    $colorModel->value = $color['value'];

                    if (!$colorModel->save()) {
                        Yii::$app->response->statusCode = 400;
                        return ResponseService::errorResponse(
                            $colorModel->getErrors()
                        );
                    }
                }
            }
            return ResponseService::successResponse(
                'Colors saved!',
                Color::find()->all()
            );
        } else {
            Yii::$app->response->statusCode = 400;
            return ResponseService::errorResponse(
                'Colors can not be empty!'
            );
        }
    }

    public function actionGetColors(): array
    {
        $colors = Color::find()->all();

        if (!empty($colors)) {
            $response = ResponseService::successResponse(
                'Colors list!',
                $colors
            );
        } else {
            Yii::$app->response->statusCode = 400;
            $response = ResponseService::errorResponse(
                'Colors not found!'
            );
        }
        return $response;
    }
}