<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-9">
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView'=>'_item',
		'layout' => "{pager}\n{items}\n{summary}",
	]) ?>
</div>
<?= $this->render('..\site\sidebar') ?>