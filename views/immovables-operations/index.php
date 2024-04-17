<?php

use app\models\ImmovablesOperations;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ImmovablesOperationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Immovables Operations';
$this->params['breadcrumbs'][] = $this->title;
$column = [
    ['class' => 'yii\grid\SerialColumn'],

    'id',
    'name',
    [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, ImmovablesOperations $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ],
];
?>
<div class="immovables-operations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Immovables Operations', ['create'], ['class' => 'btn btn-success']) ?>
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
