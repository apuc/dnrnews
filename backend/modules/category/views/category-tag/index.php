<?php

use backend\modules\category\models\Category;
use backend\modules\tag\models\Tag;
use common\models\CategoryTag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category\models\CategoryTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-tag-index">

    <p>
        <?= Html::a('Create Category Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CategoryTag $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
