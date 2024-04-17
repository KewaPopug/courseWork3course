<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Поиск по адресу';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';

echo GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        'id',
        'it_name',
        'r_name',
        'client_name',
        'address',
        'price',
        'square',
        'status'
    ],
]);
