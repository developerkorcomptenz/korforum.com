<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view">

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
            'question_title',
            'description',
            [
				'label'=>'User',
				'attribute'=>'user_id',
				'value'=>$model->user->username,
			],
            [
				'label'=>'Category',
				'attribute'=>'category_id',
				'value'=>$model->category->category_name,
			],
			[
				'attribute'=>'status',
				'value'=>$model->status == 1 ? 'Active' : 'InActive',
			],
            'created_date',
            'modified_date',
        ],
    ]) ?>
	<h3>Answers</h3>
	<?php foreach($model->answers as $answer)	{ ?>
		<?= DetailView::widget([
			'model' => $answer,
			'attributes' => [
				'id',
				[
					'label'=>'User',
					'attribute'=>'user_id',
					'value'=>$answer->user->username,
				],
				'answer',
				[
					'attribute'=>'status',
					'value'=>$answer->status == 0 ? 'Active' : 'InActive',
				],
				'created_date',
				'modified_date',
			],
		]) ?>
	<?php }	?>
</div>
