<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Question;
use common\models\User;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Answer */
/* @var $form yii\widgets\ActiveForm */

$id= yii::$app->user->identity->id;
if($model->status=='')
{
	$model->status=1;
}
?>

<div class="answer-form">
	<?php $questions=ArrayHelper::map(Question::find()->all(), 'id', 'question_title'); ?>
	<?php $users=ArrayHelper::map(User::find()->all(), 'id', 'username'); ?>   
	
	<?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'user_id')->hiddenInput(['value' => $id])->label(false) ?>

    <?=  $form->field($model, 'question_id')->dropDownList($questions) ?>

    <?= $form->field($model, 'answer')->widget(CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'basic']) ?>

    <?=  $form->field($model, 'status')->radioList(array("1"=>"Active","0"=>"InActive")) ?>	

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
