<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\battle_place\models\BattlePlace $model */

$this->title = 'Изменить место битвы: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Battle Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="battle-place-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
