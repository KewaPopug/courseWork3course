<?php

use app\models\Cashbox;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CashboxSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cashboxes';
$this->params['breadcrumbs'][] = $this->title;

$column = [
    ['class' => 'yii\grid\SerialColumn'],
    'id',
    'number',
    'personal_id',
    'client_id',
    'date_cashbox',
    'price',
    'contract_id',
    [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, Cashbox $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ],
];
?>
<div class="cashbox-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //if(Yii::$app->user->can('create')): ?>
    <p>
        <?= Html::a('Create Cashbox', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<!--    --><?php //endif; ?>
    <p>
        <?= Html::a('Приход по сотрудникам в текущем месяце', ['summary-entered-by-personal'], ['class' => 'btn btn-success']) ?>
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
