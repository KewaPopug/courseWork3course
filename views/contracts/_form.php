<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contracts $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $data */
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'immovables_id')->textInput() ?>

    <?= $form->field($model, 'immovables_id')
        ->dropDownList($data['immovables'], [
            'prompt' => 'Выберете недвижимость ...',
        ])
        ->label('Недвижимость') ?>

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

    <?= $form->field($model, 'immovables_operations_id')
        ->dropDownList($data['immovables_operations'], [
            'prompt' => 'Выберете операцию ...',
        ])
        ->label('Операции над недвижимостью') ?>

    <?= $form->field($model, 'description')->textInput()->label('Описание') ?>

    <?= $form->field($model, 'contract_period')->textInput()->label('Период контракта (месяца)') ?>

    <?= $form->field($model, 'date_cashbox')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Выберете дату ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
        ]
    ])->label('Дата создания') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
