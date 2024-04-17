<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Договора по конкретному работнику';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';

ActiveForm::begin(['options' => ['enctype' => 'contract-by-personal']]);

echo Html::dropDownList(
    'personal_id',
    '',
    $personals,
    [
        'prompt' => 'Выберете менеджера ...',
        'class' => "form-control"
    ]);

echo (($alertMessage) ?? '') . "<br>";

echo Html::submitButton('Save', ['class' => 'btn btn-success']);

ActiveForm::end();
