<?php

namespace frontend\modules\api\controllers;

use common\services\NewsService;
use common\services\ResponseService;
use frontend\modules\api\models\News;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class NewsController extends ApiController
{
    public $modelClass = 'frontend\modules\api\models\News';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'news',

    ];

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'news' => ['GET'],
                    'news-list' => ['GET'],
                    'find' => ['GET'],
                    'find-by-date' => ['GET'],
                    'add-view' => ['PATCH'],
                ],
            ]
        ]);
    }

    public function actionAddView(int $news_id): array
    {
        $news = News::findOne(['id' => $news_id]);

        if ($news) {
            NewsService::addView($news);
            $response = ResponseService::successResponse(
                'View added',
                ['current_views' => $news->views]
            );
        } else {
            $response = ResponseService::errorResponse(
                'News not found!'
            );
        }

        return $response;
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

    public function actionFind($text = null): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => NewsService::findNews($text),
        ]);
    }

    public function actionFilter(
        array $category = null,
        array $tags = null,
        int $published = null,
        int $from_date = null,
        string $battle_place_name = null
    ): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => NewsService::filter($category, $tags, $published, $from_date, $battle_place_name),
        ]);
    }
}