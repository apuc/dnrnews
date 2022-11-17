<?php

use backend\modules\battle_place\models\BattlePlace;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\modules\battle_place\models\BattlePlaceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Места сражений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-place-index">

    <p>
        <?= Html::a('Добавить место сражения', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bounds',
            'name',
            'start_date',
            'end_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BattlePlace $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
