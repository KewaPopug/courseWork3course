<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContractsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contracts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'immovables_id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'personal_id') ?>

    <?= $form->field($model, 'immovables_operations_id') ?>

    <?php  echo $form->field($model, 'description') ?>

    <?php  echo $form->field($model, 'contract_period') ?>

    <?php  echo $form->field($model, 'date_cashbox') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
