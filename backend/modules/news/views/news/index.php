<?php

use common\helpers\StatusHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Url::base() . '/photo/' . $data->photo,
                        ['width' => '80px',
                            'height' => '80px']);
                },
                'contentOptions' => ['style'=>'text-align:center'],
            ],
            'news_body:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => StatusHelper::statusList(),
                'value' => function($model){
                    return StatusHelper::statusLabel($model->status);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>


</div>
