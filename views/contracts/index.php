<?php

use app\models\Contracts;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ContractsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contracts';
$this->params['breadcrumbs'][] = $this->title;
$column = [
    ['class' => 'yii\grid\SerialColumn'],

    'number',
    'immovables_id',
    'client_id',
    'personal_id',
    'immovables_operations_id',
    'description',
    'contract_period',
    'date_cashbox',
    [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, Contracts $model, $key, $index, $column) {
            return Url::toRoute([$action, 'number' => $model->number]);
        }
    ],
];
?>
<div class="contracts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contracts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Договора по конкретному работнику', ['contract-by-personal'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Сумма договоров по операции ', ['general-sum-by-immovables-operation'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Кленты по операции ', ['client-by-immovables-operations'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=  ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $column,
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $column
    ]); ?>


</div>
