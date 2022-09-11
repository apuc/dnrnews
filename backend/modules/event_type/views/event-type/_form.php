<?php

use common\helpers\StatusHelper;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\modules\event_type\models\EventType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="event-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Select Photo',
            'initialPreview' => Html::img(
                Url::base() . '/photo/icon/' . $model->icon,
                [
                    'width' => "100%", 'height' => "100%"
                ]),
            'overwriteInitial' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(
        StatusHelper::statusList(),
        [
            'options' => [
                1 => ['selected' => true]
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
