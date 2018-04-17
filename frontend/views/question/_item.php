<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<article class="question">
	<h2><?= Html::a($model->question_title, ['question/view', 'id' => $model->id]) ?></h2>
	<?= Html::a($model->category->category_name, ['category/view', 'id' => $model->category_id], ['class' => 'question-cat']) ?>	
	<div class="question-author">
		<a href="#" class="question-author-img"><span></span>
		<img alt="" src="<?php echo Yii::$app->urlManager->createUrl("/frontend/web/images/avatar.png"); ?>"></a>
	</div>
	<div class="question-inner">
		<div class="clearfix"></div>
		<p class="question-desc"><?php echo strip_tags($model->description); ?></p>
		<div class="meta-author">
			<span class="glyphicon glyphicon-user"></span>
			<?= Html::a(ucfirst($model->user->username), ['user/view', 'id' => $model->user->id]) ?>
		</div>
		<div class="question-category">
			<span class="glyphicon glyphicon-folder-close"></span>
			<?= Html::a($model->category->category_name, ['category/view', 'id' => $model->category_id]) ?>
		</div>
		<div class="question-date">
			<span class="glyphicon glyphicon-calendar"></span>
			<?php
			if($model->created_date==$model->modified_date)
			{
				echo "asked ".Yii::$app->formatter->format(strtotime($model->created_date), 'relativeTime');  
			}
			else
			{
				echo "modified ".Yii::$app->formatter->format(strtotime($model->modified_date), 'relativeTime');  
			}
			?>
		</div>
		<div class="question-comment">
			<span class="glyphicon glyphicon-comment"></span>
			<?php echo count($model->answers). " Answer"; ?>
		</div>
		<div class="clearfix"></div>					
</article>