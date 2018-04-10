<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Answer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-view">

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
            [
				'label'=>'User',
				'attribute'=>'user_id',
				'value'=>$model->user->username,
			],
            [
				'label'=>'Question',
				'attribute'=>'question_id',
				'value'=>$model->question->question_title,
			],
            'answer',
            [
				'attribute'=>'status',
				'value'=>$model->status == 0 ? 'Active' : 'InActive',
			],
            'created_date',
            'modified_date',
        ],
    ]) ?>

</div>
