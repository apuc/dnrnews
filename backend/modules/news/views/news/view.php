<?php

use common\helpers\StatusHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

    <p>
        <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'logo',
                'format' => 'html',
                'label' => 'photo',
                'value' => function ($data) {
                    return Html::img('/photo/' . $data->photo,
                        ['width' => '80px',
                            'height' => '80px']);
                },
            ],
            'news_body:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => StatusHelper::statusLabel($model->status),
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
