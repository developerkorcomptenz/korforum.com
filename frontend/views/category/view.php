<?php

use yii\helpers\Html;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->category_name;
$this->params['breadcrumbs'][] = $model->category_name;
?>
<div class="category-view">
	<div class="row">
		<div class="col-sm-9">
			<div class="col-sm-8">
				<h2 class="text-left" style="margin-top:0px;"><?= Html::encode($model->category_name) ?></h2>
			</div>
			<div class="col-sm-4">
				<div class="text-right" style="margin-bottom:20px;">
				<?= Html::a('Create Question', ['question/create'], ['class' => 'btn btn-success']) ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php
			if(!empty($model->questions))
			{
				echo "<h3>Questions</h3>";
				foreach($model->questions as $question)
				{
					?>
					<div class="col-sm-12 well">
						<div class="question-title" style="margin-bottom:40px;">
							<h2><?= Html::a($question->question_title, ['question/view', 'id' => $question->id]) ?></h2>
						</div>
						<hr>
						<div class="col-sm-6">
						<?php echo count($question->answers). " Answers"; ?>
						</div>
						<div class="col-sm-6">
							<div class="text-right">
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
								<?php echo "by ".$question->user->username;?>
							</div>
						</div>
					</div>
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
		<div class="col-sm-3">
			<h3 class="text-center">Categories</h3>
			<?php
				$categories=Category::find()->all();
				if($categories)
				{
					echo "<ul class='list-group'>";
					foreach($categories as $category)
					{
						?><li class='list-group-item'> <?= Html::a($category->category_name, ['category/view', 'id' => $category->id], ['class' => 'btn btn-link']) ?><?php
					}
					echo "</ul>";
				}
			?>
		</div>
	</div>
</div>
