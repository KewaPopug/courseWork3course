<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ImmovablesOperations $model */

$this->title = 'Create Immovables Operations';
$this->params['breadcrumbs'][] = ['label' => 'Immovables Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="immovables-operations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
