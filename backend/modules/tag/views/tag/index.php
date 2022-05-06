<?php

use common\helpers\StatusHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\tag\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <p>
        <?= Html::a('Создать тег', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => StatusHelper::statusList(),
                'value' => function($model){
                    return StatusHelper::statusLabel($model->status);
                }
            ],
//            [
//                'attribute' => 'created_at',
//                'format' => ['datetime', 'php:d.m.Y H:i:s']
//            ],
//            [
//                'attribute' => 'updated_at',
//                'format' => ['datetime', 'php:d.m.Y H:i:s']
//            ],
            [
                'class' => ActionColumn::className(),
            ],
        ],
    ]); ?>


</div>
