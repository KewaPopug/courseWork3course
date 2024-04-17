<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Immovables $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $data */
?>

<div class="immovables-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'immovables_types_id')
        ->dropDownList($data['immovables_types'], [
            'prompt' => 'Выберете операцию ...',
        ])
        ->label('Тип недвижимости') ?>

    <?= $form->field($model, 'regions_id')
        ->dropDownList($data['regions'], [
            'prompt' => 'Выберете регион ...',
        ])
        ->label('Регион') ?>

    <?= $form->field($model, 'client_owner_id')
        ->dropDownList($data['clients'], [
            'prompt' => 'Выберете клиента ...',
        ])
        ->label('Клиент') ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'square')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
