<?php

use backend\modules\news\models\News;
use backend\modules\tag\models\Tag;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'news_id')->widget(Select2::className(),
        [
            'readonly' => true,
            'data' => News::find()->select(['title', 'id'])->where(['id' => $model->news_id])->indexBy('id')->column(),
        ]
    ) ?>

    <?= $form->field($model, 'tag_id')->widget(Select2::className(),
        [
            'data' => Tag::find()->select(['title', 'id'])->indexBy('id')->column(),
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
