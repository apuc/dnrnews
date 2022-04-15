<?php

namespace frontend\modules\api\controllers;

use common\services\NewsService;
use common\services\ResponseService;
use frontend\modules\api\models\News;

class NewsController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\News';

    public function verbs(): array
    {
        return [
            'news' => ['GET'],
            'news-list' => ['GET'],
            'find' => ['GET'],
        ];
    }

    public function actionNews($news_id): array
    {
        $response = ResponseService::successResponse(
            'News',
            News::findOne($news_id)
        );

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The news not exist!'
            );
        }
        return $response;
    }

    public function actionNewsList(array $category_id = null, array $tags_id = null): array
    {
        $response = ResponseService::successResponse(
            'News list',
            NewsService::getNews($category_id, $tags_id)
        );

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The news not exist!'
            );
        }
        return $response;
    }

    public function actionFind($title = null, $text = null)
    {
        $response = ResponseService::successResponse(
            'News list',
            NewsService::findNews($title, $text)
        );

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The news not exist!'
            );
        }
        return $response;
    }

    public function actionFindByDate(int $published, int $from_date = null): array
    {
        $response = ResponseService::successResponse(
            'News list',
            NewsService::findNewsByDate($published, $from_date)
        );

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The news not found!'
            );
        }
        return $response;
    }
}