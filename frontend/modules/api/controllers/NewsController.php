<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Category;
use frontend\modules\api\models\News;
use frontend\modules\api\models\UserNewsLike;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\rest\Controller;

class NewsController extends Controller
{
    public $modelClass = 'frontend\modules\api\models\News';//News::class;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => null,
    ];

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
                'only' => ['set-like', 'unset-like'],
            ],
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'news' => ['GET'],
                    'news-list' => ['GET'],
                    'set-like' => ['POST'],
                    'unset-like' => ['DELETE']
                ],
            ],
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionNews($news_id): array
    {
        $response['isSuccess'] = 200;
        $response['news'] = News::findOne($news_id);

        if (empty($response['news'])) {
            throw new NotFoundHttpException('The news not exist!');
        }
        return $response;
    }

    public function actionNewsList($category_id = null, array $tags_id = null): array
    {
        $query = News::find();

        $query->distinct()
            ->joinWith(['category', 'tags']);

        if (!empty($category_id)) {
            $query->andFilterWhere(['=', 'category.id', $category_id]);
        }

        if (!empty($tags_id)) {
            $query->andFilterWhere(['=', 'tag.id', $tags_id[0]]);
            if (count($tags_id) > 1) {
                for ($i = 1; $i < count($tags_id); ++$i) {
                    $query->orFilterWhere(['=', 'tag.id', $tags_id[$i]]);
                }
            }

        }

        $news = $query->all();

        if (empty($news)) {
            throw new NotFoundHttpException('The news not exist!');
        }

        $response['isSuccess'] = 200;
        $response['news'] = $news;

        return $response;
    }

    public function actionSetLike()
    {
//        $model = new UserNewsLike();
//        $model->user_id = \Yii::$app->user->identity->id;
//        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
//            $response['isSuccess'] = 200;
//            $response['message'] = 'Like is created!';
//            $response['user_news_like'] = $model;
//        } else {
//            $model->getErrors();
//            $response['hasErrors'] = $model->hasErrors();
//            $response['errors'] = $model->errors;
//            $response['user_news_like'] = $model;
//        }
//        return $response;
    }

    public function actionUnsetLike()
    {

    }
}