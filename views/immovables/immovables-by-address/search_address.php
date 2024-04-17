<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Поиск по адресу';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';

ActiveForm::begin(['options' => ['enctype' => 'immovables-by-address']]);

echo Html::label('Адрес', 'address');
echo Html::textInput('address', '', ['class' => 'form-control']);

echo (($alertMessage) ?? '') . "<br>";

echo Html::submitButton('Save', ['class' => 'btn btn-success']);

ActiveForm::end();
