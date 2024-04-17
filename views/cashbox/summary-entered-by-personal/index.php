<?php

use kartik\export\ExportMenu;
use yii\grid\GridView;
use yii\helpers\Html;

$column = [
    'id',
    'name',
    'sum_price'
];

$this->title = 'Приход по сотрудникам в текущем месяце';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';

echo ExportMenu::widget([
    'dataProvider' => $data,
    'columns' => $column,
]);

echo GridView::widget([
    'dataProvider' => $data,
    'columns' => $column,
]);
