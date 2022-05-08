<?php

use backend\modules\category\models\Category;
use backend\modules\tag\models\Tag;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\CategoryTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->widget(Select2::className(),
        [
            'readonly' => true,
            'data' => Category::find()->select(['title', 'id'])->where(['id' => $model->category_id])->indexBy('id')->column(),
        ]
    ) ?>

    <?= $form->field($model, 'tag_id')->widget(Select2::className(),
        [
            'data' => Tag::find()->select(['title', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Выберите', 'class' => 'form-control'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
                'closeOnSelect' => false
            ],
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
