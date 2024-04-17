<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ImmovablesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="immovables-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'immovables_types_id') ?>

    <?= $form->field($model, 'regions_id') ?>

    <?= $form->field($model, 'client_owner_id') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'square') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
