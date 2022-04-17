<?php

namespace frontend\modules\api\controllers;

use common\services\NewsService;
use common\services\ResponseService;
use yii\data\ActiveDataProvider;

class NewsController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\News';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'news',

    ];

    public function verbs(): array
    {
        return [
            'news' => ['GET'],
            'news-list' => ['GET'],
            'find' => ['GET'],
            'find-by-date' => ['GET'],
        ];
    }

    public function actionNews($news_id): array
    {
        $response = ResponseService::successResponse(
            'News',
            NewsService::getNews($news_id)
        );

        if (empty($response['data'])) {
            $response = ResponseService::errorResponse(
                'The news not exist!'
            );
        }
        return $response;
    }

    public function actionNewsList(array $category_id = null, array $tags_id = null): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => NewsService::getNewsList($category_id, $tags_id),
        ]);
    }

    public function actionFind($title = null, $text = null): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => NewsService::findNews($title, $text),
        ]);
    }

    public function actionFindByDate(int $published, int $from_date = null): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => NewsService::findNewsByDate($published, $from_date),
        ]);
    }
}