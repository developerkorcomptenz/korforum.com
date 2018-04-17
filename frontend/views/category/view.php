<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->category_name;
$this->params['breadcrumbs'][] = $model->category_name;
?>
<div class="col-md-9">
	<?php
	if(!empty($model->questions))
	{
		foreach($model->questions as $question)
		{
			?>
			<article class="question">
				<h2><?= Html::a($question->question_title, ['question/view', 'id' => $question->id]) ?></h2>
				<?= Html::a($question->category->category_name, ['category/view', 'id' => $question->category_id], ['class' => 'question-cat']) ?>	
				<div class="question-author">
					<a href="#" class="question-author-img"><span></span>
					<img alt="" src="<?php echo Yii::$app->urlManager->createUrl("/frontend/web/images/avatar.png"); ?>"></a>
				</div>
				<div class="question-inner">
					<div class="clearfix"></div>
					<p class="question-desc"><?php echo strip_tags($question->description); ?></p>
					<div class="meta-author">
						<span class="glyphicon glyphicon-user"></span>
						<?= Html::a(ucfirst($question->user->username), ['user/view', 'id' => $question->user->id]) ?>
					</div>
					<div class="question-category">
						<span class="glyphicon glyphicon-folder-close"></span>
						<?= Html::a($question->category->category_name, ['category/view', 'id' => $question->category_id]) ?>
					</div>
					<div class="question-date">
						<span class="glyphicon glyphicon-calendar"></span>
						<?php
						if($question->created_date==$question->modified_date)
						{
							echo "asked ".Yii::$app->formatter->format(strtotime($question->created_date), 'relativeTime');  
						}
						else
						{
							echo "modified ".Yii::$app->formatter->format(strtotime($question->modified_date), 'relativeTime');  
						}
						?>
					</div>
					<div class="question-comment">
						<span class="glyphicon glyphicon-comment"></span>
						<?php echo count($question->answers). " Answer"; ?>
					</div>
					<div class="clearfix"></div>					
			</article>	
		<?php
		}
	}
	else
	{
		?>
		<div class="site-error"><div class="alert alert-warning">No records found!.    </div></div>
		<?php
	}
	?>
</div>
<?= $this->render('..\site\sidebar') ?>