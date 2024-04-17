<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Договора по операции';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';

ActiveForm::begin(['options' => ['enctype' => 'general-sum-by-immovables-operation']]);

echo Html::dropDownList(
    'immovables_operation_id',
    '',
    $immovablesOperations,
    [
        'prompt' => 'Выберете Операцию ...',
        'class' => "form-control"
    ]);

echo (($alertMessage) ?? '') . "<br>";

echo Html::submitButton('Save', ['class' => 'btn btn-success']);

ActiveForm::end();
