<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CashboxSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cashbox-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'personal_id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'date_cashbox') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'contract_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
