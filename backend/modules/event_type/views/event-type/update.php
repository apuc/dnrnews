<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\modules\event_type\models\EventType $model */

$this->title = 'Update Event Type: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Event Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
