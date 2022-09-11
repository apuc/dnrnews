<?php

use common\helpers\StatusHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\modules\event_type\models\EventType $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Event Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-type-view">

    <p>
        <?= Html::a('Список', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'attribute' => 'icon',
                'format' => 'html',
                'label' => 'icon',
                'value' => function ($data) {
                    return Html::img(Url::base() . '/photo/icon/' . $data->icon,
                        ['width' => '80px',
                            'height' => '80px']);
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => StatusHelper::statusLabel($model->status),
            ],
        ],
    ]) ?>

</div>
