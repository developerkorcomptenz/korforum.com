<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = $mvQuestion->question_title;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $mvQuestion->question_title;
$user_id='';
if(Yii::$app->user->identity)
{
	$user_id=Yii::$app->user->identity->id;
}
?>
<div class="col-md-9">
	<article class="question single-question question-type-normal">
		<h2>
			<?= Html::encode($mvQuestion->question_title) ?>
		</h2>
		<div class="question-actions">
			<?php
			if($mvQuestion->user_id == $user_id)
			{
				?>
				<?= Html::a('Edit', ['update', 'id' => $mvQuestion->id], ['class' => 'action-edit']) ?>
				<?= Html::a('Delete', ['delete', 'id' => $mvQuestion->id], [
					'class' => 'action-delete',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
				<?php
			}
			?>
		</div>
		<div class="question-inner">
			<div class="clearfix"></div>
			<div class="question-desc"><?php echo strip_tags($mvQuestion->description); ?></div>						
			<div class="question-category">
				<span class="glyphicon glyphicon-folder-close"></span>
				<?= Html::a($mvQuestion->category->category_name, ['category/view', 'id' => $mvQuestion->category_id]) ?>
			</div>
			<div class="question-date">
				<span class="glyphicon glyphicon-calendar"></span>
				<?php
				if($mvQuestion->created_date==$mvQuestion->modified_date)
				{
					echo "asked ".Yii::$app->formatter->format(strtotime($mvQuestion->created_date), 'relativeTime');  
				}
				else
				{
					echo "modified ".Yii::$app->formatter->format(strtotime($mvQuestion->modified_date), 'relativeTime');  
				}
				?>
			</div>
			<div class="question-comment">
				<span class="glyphicon glyphicon-comment"></span>
				<?php echo count($mvQuestion->answers). " Answer"; ?>
			</div>	
			<div class="about-author">
				<div class="author-name">			
					<?= Html::a(ucfirst($mvQuestion->user->username), ['user/view', 'id' => $mvQuestion->user->id]) ?>
				</div>
				<div class="author-image">
					<a href="#" class="question-author-img"><span></span>
					<img alt="" src="<?php echo Yii::$app->urlManager->createUrl("/frontend/web/images/avatar.png"); ?>"></a>
				</div>				
			</div>
			<div class="clearfix"></div>
		</div>
	</article>
	<div id="answerlist">
		<?php
		if($mvQuestion->answers)
		{
			echo "<h3>Answers (".count($mvQuestion->answers).") </h3><ol class='answerlist clearfix'>";
			foreach($mvQuestion->answers as $answer)
			{
				?>				
				<li class="answer">
					<div class="answer-body"> 
						<div class="avatar"><img alt="" src="<?php echo Yii::$app->urlManager->createUrl("/frontend/web/images/avatar.png"); ?>"></div>
						<div class="answer-text">
							<div class="author clearfix">
								<div class="answer-author"><?= Html::a(ucfirst($answer->user->username), ['user/view', 'id' => $answer->user->id]) ?></div>								
								<div class="answer-meta">
									<div class="date"><i class="icon-time"></i><?php echo date("F m,Y H:i a",strtotime($answer->modified_date)); ?></div> 
								</div> 							
								<div class="answer-actions">
									<?php
									if($answer->user_id == $user_id)
									{
										?>
										<?= Html::a('Edit', ['answer/update', 'id' => $answer->id], ['class' => 'action-edit']) ?>
										<?= Html::a('Delete', ['answer/delete', 'id' => $answer->id], [
											'class' => 'action-delete',
											'data' => [
												'confirm' => 'Are you sure you want to delete this item?',
												'method' => 'post',
											],
										]) ?>
										<?php
									}
									?>
								</div>
							</div>
							<div class="text"><?php echo $answer->answer; ?></p>
							</div>
						</div>
					</div>
				</li>	
				<?php
			}
			echo "</ol>";
		}
		?>
	</div>
	<?php
	if(!Yii::$app->user->isGuest)
	{
		?>
		<div class="answer-respond clearfix">
			<div class="page-title"><h2>Leave a reply</h2></div>		
			<?= $this->render('..\answer\_form', [
				'mvAnswer' => $mvAnswer, 'vQuestionId' => $mvQuestion->id,
			]) ?>
		</div>		
		<?php
	}
	?>	
</div>
<?= $this->render('..\site\sidebar') ?>