<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Immovables $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Immovables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="immovables-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Типы имуществ',
                'format' => 'raw',
                'value' => function($data){
                    return $data->immovablesTypes->name;
                }
            ],
            [
                'label' => 'Район',
                'format' => 'raw',
                'value' => function($data){
                    return $data->regions->name;
                }
            ],
            [
                'label' => 'Владелец',
                'format' => 'raw',
                'value' => function($data){
                    return $data->clientOwner->name;
                }
            ],
            'address',
            'price',
            'square',
            'description',
            'status',
        ],
    ]) ?>

</div>
