<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\CategoryNews */

$this->title = 'Create Category News';
$this->params['breadcrumbs'][] = ['label' => 'Category News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-news-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
