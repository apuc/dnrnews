<?php

use backend\modules\category\models\Category;
use backend\modules\news\models\CategoryNews;
use backend\modules\news\models\News;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\CategoryNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-news-index">

    <p>
        <?= Html::a('Create Category News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'news_id',
                'filter' => News::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'news.title'
            ],
            [
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'category.title'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CategoryNews $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
