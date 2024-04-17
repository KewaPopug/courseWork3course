<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cashbox $model */
/** @var array $data */

$this->title = 'Create Cashbox';
$this->params['breadcrumbs'][] = ['label' => 'Cashboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbox-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data
    ]) ?>

</div>
