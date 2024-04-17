<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Contracts $model */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contracts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'number' => $model->number], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'number' => $model->number], [
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
            'number',
            [
                'label' => 'Адрес',
                'format' => 'raw',
                'value' => function($data){
                    return $data->immovables->address;
                }
            ],
            [
                'label' => 'Менеджер',
                'format' => 'raw',
                'value' => function($data){
                    return $data->personal->name;
                }
            ],
            [
                'label' => 'Клиент',
                'format' => 'raw',
                'value' => function($data){
                    return $data->client->name;
                }
            ],
            [
                'label' => 'Операция над имуществом',
                'format' => 'raw',
                'value' => function($data){
                    return $data->immovablesOperations->name;
                }
            ],
            'description',
            'contract_period',
            'date_cashbox',
        ],
    ]) ?>

</div>
