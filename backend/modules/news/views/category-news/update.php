<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\CategoryNews */

$this->title = 'Изменение категории у новости: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Category News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-news-update">

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
