<?php

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\CategoryTag */

$this->title = 'Назначить категории теги';
$this->params['breadcrumbs'][] = ['label' => 'Category Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-tag-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
