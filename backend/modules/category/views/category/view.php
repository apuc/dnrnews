<?php

use backend\modules\category\models\Category;
use backend\modules\tag\models\Tag;
use common\helpers\StatusHelper;
use common\helpers\UnixTimeConverter;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\Category */
/* @var $categoryTagDataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">

    <p>
        <?= Html::a('Список', ['index'], ['class' => 'btn btn-primary']) ?>
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
                'attribute' => 'status',
                'format' => 'raw',
                'value' => StatusHelper::statusLabel($model->status),
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return UnixTimeConverter::convertUnixToDate($model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return UnixTimeConverter::convertUnixToDate($model->created_at);
                }
            ],
        ],
    ]) ?>

    <div>
        <h2>
            <?= 'Теги категории: '?>
        </h2>
    </div>

    <?= GridView::widget([
        'dataProvider' => $categoryTagDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'tag_id',
                'filter' => Tag::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'tag.title'
            ],
            [
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'category.title'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [

                    'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            ['category-tag/update', 'id' => $model['id'], 'category_id' => $model['category_id']]);
                    },
                    'delete' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            [
                                'category-tag/delete', 'id' => $model['id'], 'category_id' => $model['category_id']
                            ],
                            [
                                'data' => ['confirm' => 'Вы уверены, что хотите удалить этот тег?', 'method' => 'post']
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a(
            'Добавить новый тег',
            ['category-tag/create', 'category_id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
    </p>

</div>
