<?php

use app\models\Contracts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FullViewTableWithRelationsImmovablesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Общий вид недвижимости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contracts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'immovables_types',
            'regions',
            'clients',
            'address',
            'price',
            'square',
            'description',
            'status',

//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Contracts $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'number' => $model->number]);
//                 }
//            ],
        ],
    ]); ?>


</div>
