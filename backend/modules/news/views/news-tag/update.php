<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsTag */

$this->title = 'Update News Tag: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'News Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-tag-update">

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
