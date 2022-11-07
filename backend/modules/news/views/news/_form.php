<?php

use common\helpers\StatusHelper;
use dosamigos\multiselect\MultiSelect;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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
                Url::base() . '/photo/' . $model->photo,
                [
                    'width' => "100%", 'height' => "100%"
                ]),
            'overwriteInitial' => true
        ],
    ]); ?>

    <?= $form->field($model, '_category')->widget(MultiSelect::className(),[
        'data' => \common\models\Category::getList() ?: ['Категории ещё не созданы'],
        'options' => ['multiple'=>"multiple"],
    ])->label("Категория") ?>

    <?=  $form->field($model, '_tag')->widget(Select2::classname(), [
        'data' => \common\models\Tag::getList() ?: [],
        'language' => 'de',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите теги ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'news_body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dateTime')->widget(DateTimePicker::className(), [
        'name' => 'datetime',
        'options' => ['placeholder' => 'Выберите дату...'],
        'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
        'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
        'pluginOptions' => [
            'language' => 'ru',
//            'minuteStep' => '60',
//            'minView' => '2',
//            'maxView' => '2',
//'startView' => '3',
            'format' => 'dd-M-yyyy HH:ii P', // формат который будет передаваться в базу
            'autoclose' => true, //авто закрытие
            'weekStart' => 1, //с какого дня начинается неделя
            'startDate' => date('d'), //дата ниже которой нельзя установить значение
            'todayBtn' => true, // выбрать сегодняшнюю дату
            'todayHighlight' => true, // подсветка сегодняшнего дня
        ],
    ]);
    ?>

    <?= $form->field($model, 'coordinates')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'event_type_id')->widget(Select2::classname(), [
        'data' => \common\models\EventType::getList() ?: [],
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите тип ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'is_map_event')->checkbox() ?>

    <?= $form->field($model, 'status')->dropDownList(
        StatusHelper::statusList(),
        [
            'options' => [
                1 => ['selected' => true]
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
