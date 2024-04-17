<?php

use kartik\export\ExportMenu;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Таблица физических лиц';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';
$column = [
    'id',
    'name',
    'address',
    'phone',
    'attribute'
];

echo ExportMenu::widget([
    'dataProvider' => $data,
    'columns' => $column,
]);

echo GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        'id',
        'name',
        'address',
        'phone',
        'attribute'
    ],
]);
