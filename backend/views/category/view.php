<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_name',
            'slug',
            'parent',
        ],
    ]) ?>
	<h3>Questions</h3>
	<?php
	if(!empty($model->questions))
	{
		foreach($model->questions as $question)
		{
			?>
			<?= DetailView::widget([
				'model' => $question,
				'attributes' => [
					'id',
					'question_title',
					'description',
					[
						'label'=>'User',
						'attribute'=>'user_id',
						'value'=>$question->user->username,
					],
					[
						'label'=>'Category',
						'attribute'=>'category_id',
						'value'=>$question->category->category_name,
					],
					[
						'attribute'=>'status',
						'value'=>$question->status == 0 ? 'Active' : 'InActive',
					],
					'created_date',
					'modified_date',
				],
			]) ?>
			<?php			
		}
	}
	?>
</div>
