<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">
	<div class="row">
	    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
		<div class="col-sm-9">
			<div class="col-sm-8">
				<h2 class="text-left" style="margin-top:0px;"><?= Html::encode($this->title) ?></h2>
			</div>
			<div class="col-sm-4">
				<div class="text-right" style="margin-bottom:20px;">
				<?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
			<?= ListView::widget([
					'dataProvider' => $dataProvider,
					'itemView'=>'_item',
					'layout' => "{pager}\n{items}\n{summary}",
				]) ?>
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