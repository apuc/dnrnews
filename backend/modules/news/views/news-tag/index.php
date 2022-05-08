<?php

use backend\modules\news\models\News;
use backend\modules\news\models\NewsTag;
use backend\modules\tag\models\Tag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\NewsTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Теги новостей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-tag-index">

    <p>
        <?= Html::a('Добавить новости тег', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'attribute' => 'tag_id',
                'filter' => Tag::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'tag.title'
            ],
        ],
    ]); ?>


</div>
