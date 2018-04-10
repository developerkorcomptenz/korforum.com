<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-sm-12 well">
	<div class="question-title" style="margin-bottom:40px;">
		<h2><?= Html::a($model->question_title, ['question/view', 'id' => $model->id]) ?></h2>
	</div>
	<hr>
	<div class="col-sm-6">
	<?php echo count($model->answers). " Answers"; ?>
	</div>
	<div class="col-sm-6">
		<div class="text-right">
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
			<?php echo "by ".$model->user->username;?>
		</div>
	</div>
</div>

