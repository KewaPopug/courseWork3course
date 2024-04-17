<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ImmovablesTypes $model */

$this->title = 'Create Immovables Types';
$this->params['breadcrumbs'][] = ['label' => 'Immovables Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="immovables-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
