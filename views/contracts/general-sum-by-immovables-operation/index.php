<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Договора по операции';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';

echo GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        'name',
        'general_sum',
    ],
]);
