<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\modules\battle_place\models\BattlePlace $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="battle-place-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'upper_point')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'lower_point')->textarea(['rows' => 1]) ?>

    <p>Пример формата точки: 48.121012394914274,37.706623077392585</p>

    <?= $form->field($model, 'scale')->widget(Select2::className(),
        [
            'data' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
            'options' => ['placeholder' => 'Выберите масштаб','class' => 'form-control'],
            'pluginOptions' => [
                'allowClear' => false,
                'closeOnSelect' => true
            ],
        ]) ?>

    <?=  $form-> field($model, 'start_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ]);
    ?>

    <?=  $form-> field($model, 'end_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Введите дату'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ]);
    ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' => 'Select Photo',
            'initialPreview' => Html::img(
                Url::base() . '/battle_place_photo/' . $model->photo,
                [
                    'width' => "100%", 'height' => "100%"
                ]),
            'overwriteInitial' => true
        ],
    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
