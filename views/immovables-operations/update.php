<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ImmovablesOperations $model */

$this->title = 'Update Immovables Operations: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Immovables Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="immovables-operations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
