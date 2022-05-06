<?php

use backend\modules\news\models\News;
use common\helpers\StatusHelper;
use common\models\User;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\comment\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Коментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <p>
        <?= Html::a('Создать комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'filter' => User::find()->select(['username', 'id'])->indexBy('id')->column(),
                'value' => 'user.username'
            ],
            [
                'attribute' => 'news_id',
                'filter' => News::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'news.title'
            ],
            'comment_body',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => StatusHelper::statusList(),
                'value' => function ($model) {
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
