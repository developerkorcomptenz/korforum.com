<?php

use yii\helpers\Html;
use common\models\Question;

/* @var $this yii\web\View */

$this->title = 'Korcomptenz Forum';
?>

<div class="col-md-9">
	<h2 class="question-title">Questions</h2>
	<?php
	$questions=Question::find()->all();
	if($questions)
	{
		foreach($questions as $question)
		{
			if($question->status=='1')
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
							<a href="#"><?php echo ucfirst($question->user->username); ?></a>
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
	}
	?>
</div>
<?= $this->render('..\site\sidebar') ?>
