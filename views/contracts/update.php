<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Contracts $model */
/** @var array $data */

$this->title = 'Update Contracts: ' . $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->number, 'url' => ['view', 'number' => $model->number]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contracts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data
    ]) ?>

</div>
