<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Immovables $model */
/** @var array $data */

$this->title = 'Create Immovables';
$this->params['breadcrumbs'][] = ['label' => 'Immovables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="immovables-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data
    ]) ?>

</div>
