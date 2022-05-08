<?php

use backend\modules\category\models\Category;
use backend\modules\news\models\News;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\CategoryNews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'news_id')->widget(Select2::className(),
        [
            'readonly' => true,                                    //$model->category_id
            'data' => News::find()->select(['title', 'id'])->where(['id' => 78])->indexBy('id')->column(),
        ]
    ) ?>

    <?= $form->field($model, 'category_id')->widget(Select2::className(),
        [
            'data' => Category::find()->select(['title', 'id'])->indexBy('id')->column(),
            'options' => ['placeholder' => 'Выберите', 'class' => 'form-control'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
