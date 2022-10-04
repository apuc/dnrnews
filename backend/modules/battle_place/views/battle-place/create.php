<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\battle_place\models\BattlePlace $model */

$this->title = 'Создание места сражения';
$this->params['breadcrumbs'][] = ['label' => 'Battle Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-place-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
