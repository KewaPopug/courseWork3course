<?php

use app\models\Personal;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PersonalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Personals';
$this->params['breadcrumbs'][] = $this->title;

$column =  [
    ['class' => 'yii\grid\SerialColumn'],

    'id',
    'name',
    [
        'class' => ActionColumn::className(),
        'urlCreator' => function ($action, Personal $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ],
];
?>
<div class="personal-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //if(Yii::$app->user->can('personal/create')): ?>
    <p>
        <?= Html::a('Create Personal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<!--    --><?php //endif; ?>
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
