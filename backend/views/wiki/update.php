<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Wiki */

$this->title = 'Update Wiki:'.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Wikis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wiki-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php //echo "<pre>";print_r($model); ?>
</div>
