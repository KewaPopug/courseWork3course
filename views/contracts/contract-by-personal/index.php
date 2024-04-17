<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Договора по конкретному работнику';

echo '<h1>' . Html::encode($this->title) . '</h1><br>';

echo GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        'immovables_id',
        'client_name',
        'personal_id',
        'personal_name',
        'immovables_operations_name'
    ],
]);
