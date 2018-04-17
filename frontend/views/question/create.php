<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = 'Create Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-9">
	<div class="page-content">
		<div class="page-title"><h2><?= Html::encode($this->title) ?></h2></div>
		<div class="form-style" id="question-submit">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>
	</div>
</div>
<?= $this->render('..\site\sidebar') ?>
