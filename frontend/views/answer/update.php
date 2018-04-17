<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $mvAnswer frontend\models\Answer */

$this->title = 'Edit Answer: '.$mvAnswer->question->question_title;
$this->params['breadcrumbs'][] = ['label' => 'Question', 'url' => ['question/index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="col-md-9">
	<div class="page-content">
		<div class="page-title"><h2><?= Html::encode($mvAnswer->question->question_title) ?></h2></div>
		<div class="form-style" id="question-submit">
			<?= $this->render('_form', [
				'mvAnswer' => $mvAnswer,  'vQuestionId' => $mvAnswer->question_id,
			]) ?>
		</div>
	</div>
</div>
<?= $this->render('..\site\sidebar') ?>
