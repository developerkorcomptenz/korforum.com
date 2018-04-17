<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WikiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-9">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView'=>'_item',
		'layout' => "{pager}\n{items}\n{summary}",
    ]) ?>
</div>
<?= $this->render('..\site\sidebar') ?>