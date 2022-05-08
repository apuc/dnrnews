<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\CategoryTag */

$this->title = 'Изменение тега категории: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Category Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-tag-update">

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
