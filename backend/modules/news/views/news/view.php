<?php

use backend\modules\category\models\Category;
use backend\modules\tag\models\Tag;
use common\helpers\StatusHelper;
use common\helpers\UnixTimeConverter;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $categoryNewsDataProvider yii\data\ActiveDataProvider */
/* @var $newsTagDataProvider yii\data\ActiveDataProvider */

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
                    return Html::img(Url::base() . '/photo/' . $data->photo,
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
            <?= 'Категории новости: ' ?>
        </h2>
    </div>

    <?= GridView::widget([
        'dataProvider' => $categoryNewsDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'category.title'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [

                    'update' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            ['category-news/update', 'id' => $model['id'], 'news_id' => $model['news_id']]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            [
                                'category-news/delete', 'id' => $model['id'], 'news_id' => $model['news_id']
                            ],
                            [
                                'data' => ['confirm' => 'Вы уверены, что хотите убрать эту категорию?', 'method' => 'post']
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a(
            'Добавить категорию',
            ['category-news/create', 'news_id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
    </p>

    <div>
        <h2>
            <?= 'Теги новости: ' ?>
        </h2>
    </div>

    <?= GridView::widget([
        'dataProvider' => $newsTagDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'tag_id',
                'filter' => Tag::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'tag.title'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [

                    'update' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            ['news-tag/update', 'id' => $model['id'], 'news_id' => $model['news_id']]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            [
                                'news-tag/delete', 'id' => $model['id'], 'news_id' => $model['news_id']
                            ],
                            [
                                'data' => ['confirm' => 'Вы уверены, что хотите убрать эту категорию?', 'method' => 'post']
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a(
            'Добавить тег',
            ['news-tag/create', 'news_id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
    </p>

</div>
