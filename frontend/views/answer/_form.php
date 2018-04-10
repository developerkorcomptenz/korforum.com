<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Question;
use common\models\User;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $mvAnswer common\models\Answer */
/* @var $form yii\widgets\ActiveForm */
$id= yii::$app->user->identity->id;
?>

<div class="answer-form">
	<?php $questions=ArrayHelper::map(Question::find()->all(), 'id', 'question_title'); ?>
	<?php $users=ArrayHelper::map(User::find()->all(), 'id', 'username'); ?>   
	
	<?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($mvAnswer, 'user_id')->hiddenInput(['value' => $id])->label(false) ?>
	
	<?=  $form->field($mvAnswer, 'question_id')->hiddenInput(['value' => $vQuestionId])->label(false) ?>

    <?= $form->field($mvAnswer, 'answer')->widget(CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'basic'])->label('Your Answer') ?>

    <?=  $form->field($mvAnswer, 'status')->hiddenInput(['value' => 1])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
