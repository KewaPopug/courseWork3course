<?php

use app\models\Immovables;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ImmovablesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Immovables';
$this->params['breadcrumbs'][] = $this->title;
$column = [
    ['class' => 'yii\grid\SerialColumn'],

    'id',
    'immovables_types_id',
    'regions_id',
    'client_owner_id',
    'address',
    'price',
    'square',
    'description',
    'status',
    [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, Immovables $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ],
];
?>
<div class="immovables-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Immovables', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Количество недвижимости по регионам', ['immovables-group-by-region'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Поиск по адресу', ['immovables-by-address'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Недвижимость по статусу', ['immovables-by-status'], ['class' => 'btn btn-success']) ?>
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
