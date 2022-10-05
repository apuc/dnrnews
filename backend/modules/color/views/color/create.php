<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\color\models\Color $model */

$this->title = 'Создать цвет';
$this->params['breadcrumbs'][] = ['label' => 'Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
