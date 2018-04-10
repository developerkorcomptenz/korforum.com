<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $mvAnswer frontend\models\Answer */

$this->title = 'Update Answer: '.$mvAnswer->id;
$this->params['breadcrumbs'][] = ['label' => 'Question', 'url' => ['question/index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="answer-update">

    <h1><?= Html::encode($mvAnswer->question->question_title) ?></h1>

    <?= $this->render('_form', [
        'mvAnswer' => $mvAnswer,  'vQuestionId' => $mvAnswer->question_id,
    ]) ?>

</div>
