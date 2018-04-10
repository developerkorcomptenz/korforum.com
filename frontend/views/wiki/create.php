<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Wiki */

$this->title = 'Create Wiki';
$this->params['breadcrumbs'][] = ['label' => 'Wikis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wiki-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
