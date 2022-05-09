<?php

namespace frontend\modules\api\controllers;

use common\services\ResponseService;
use frontend\modules\api\models\Category;

class CategoryController extends ApiController
{
    public $modeClass = Category::class;

    public function verbs(): array
    {
        return [
            'category' => ['GET'],
        ];
    }

    public function actionCategory($category_id = null): array
    {
        if ($category_id) {
            $response = ResponseService::successResponse(
                'One category.',
                Category::find()
                    ->where(['id' => $category_id])
                    ->andWhere(['category.status' => Category::STATUS_ACTIVE])
                    ->one()
            );
        } else {
            $response = ResponseService::successResponse(
                'Category list.',
                Category::find()
                    ->where(['category.status' => Category::STATUS_ACTIVE])
                    ->all()
            );
        }

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'Category not exist!'
            );
        }
        return $response;
    }
}