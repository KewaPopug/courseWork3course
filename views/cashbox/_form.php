<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cashbox $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $data */
?>

<div class="cashbox-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'number')->textInput()->label('Номер') ?>

    <?= $form->field($model, 'personal_id')
        ->dropDownList($data['personals'], [
            'prompt' => 'Выберете менеджера ...',
        ])
        ->label('Менеджер') ?>

    <?= $form->field($model, 'client_id')
        ->dropDownList($data['clients'], [
            'prompt' => 'Выберете клиента ...',
        ])
        ->label('Клиент') ?>

    <?= $form->field($model, 'contract_id')
        ->dropDownList($data['contracts'], [
            'prompt' => 'Выберете номер контракта ...',
        ])
        ->label('Контракт') ?>


    <?= $form->field($model, 'date_cashbox')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Выберете дату ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
        ]
    ])->label('Дата создания') ?>

    <?= $form->field($model, 'price')->textInput()->label('Цена') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
