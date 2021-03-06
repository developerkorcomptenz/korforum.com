<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WikiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wikis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wiki-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="float: right;">
        <?= Html::a('Create Wiki', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView'=>'_item',
    ]) ?>
</div>
