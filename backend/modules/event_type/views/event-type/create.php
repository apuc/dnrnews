<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\event_type\models\EventType $model */

$this->title = 'Добавить тип события';
$this->params['breadcrumbs'][] = ['label' => 'Типы событий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
