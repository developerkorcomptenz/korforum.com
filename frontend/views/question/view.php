<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = $mvQuestion->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $mvQuestion->question_title;
$user_id='';
if(Yii::$app->user->identity)
{
	$user_id=Yii::$app->user->identity->id;
}
?>
<div class="question-view">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 well">
				<div id="question-header">
					<h3><?= Html::encode($mvQuestion->question_title) ?></h3>		
					<div class="question-actions">
						<?php
						if($mvQuestion->user_id == $user_id)
						{
							?>
							<?= Html::a('Edit', ['update', 'id' => $mvQuestion->id], ['class' => 'btn btn-primary']) ?>
							<?= Html::a('Delete', ['delete', 'id' => $mvQuestion->id], [
								'class' => 'btn btn-danger',
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
				<div class="clearfix"></div>
				<div class="question-description">
					<?php echo $mvQuestion->description; ?>				
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="col-sm-6">
					<?= Html::a($mvQuestion->category->category_name, ['category/view', 'id' => $mvQuestion->category_id], ['class' => 'btn btn-info']) ?>
				</div>
				<div class="col-sm-6">
					<div class="user-info text-right">
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
							<br>
							<?php echo "".$mvQuestion->user->username;?>
					</div>
				</div>
			</div>		
			<?php
			if($mvQuestion->answers)
			{
				echo "<h3>Answers</h3>";
				foreach($mvQuestion->answers as $answer)
				{
					?>
					<div class="col-sm-12 well">
						<div class="answer-description">
							<?php echo $answer->answer; ?>				
						</div>
						<div class="clearfix"></div>
						<hr>
						<div class="col-sm-6">
							<div class="answer-actions">
								<?php
								if($answer->user_id == $user_id)
								{
									?>
									<?= Html::a('Edit', ['answer/update', 'id' => $answer->id], ['class' => 'btn btn-primary']) ?>
									<?= Html::a('Delete', ['answer/delete', 'id' => $answer->id], [
										'class' => 'btn btn-danger',
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
						<div class="col-sm-6">
							<div class="user-info text-right">
									<?php
									if($answer->created_date==$answer->modified_date)
									{
										echo "asked ".Yii::$app->formatter->format(strtotime($answer->created_date), 'relativeTime');  
									}
									else
									{
										echo "modified ".Yii::$app->formatter->format(strtotime($answer->modified_date), 'relativeTime');  
									}
									?>
									<br>
									<?php echo "".$answer->user->username;?>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
			<div class="col-sm-12">
				<?php
				if(!Yii::$app->user->isGuest)
				{
					?>
					<?= $this->render('..\answer\_form', [
						'mvAnswer' => $mvAnswer, 'vQuestionId' => $mvQuestion->id,
					]) ?>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
