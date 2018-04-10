<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\User;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */

$id= yii::$app->user->identity->id;
if($model->status=='')
{
	$model->status=1;
}
?>

<div class="question-form">
	<?php $categories=ArrayHelper::map(Category::find()->all(), 'id', 'category_name'); ?>
	<?php $users=ArrayHelper::map(User::find()->all(), 'id', 'username'); ?>
	
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'basic']) ?>
	
	<?=  $form->field($model, 'user_id')->hiddenInput(['value' => $id])->label(false) ?>

    <?=  $form->field($model, 'category_id')->dropDownList($categories) ?>
	
    <?=  $form->field($model, 'status')->radioList(array("1"=>"Active","0"=>"InActive")) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
