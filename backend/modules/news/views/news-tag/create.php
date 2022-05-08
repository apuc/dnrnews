<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsTag */

$this->title = 'Create News Tag';
$this->params['breadcrumbs'][] = ['label' => 'News Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-tag-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
