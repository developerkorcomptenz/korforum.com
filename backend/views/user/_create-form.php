<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Designation;
use common\models\Technology;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

if(empty($model->status)){
	$model->status = "10";
}
?>

<div class="user-form">
	<?php $designations=ArrayHelper::map(Designation::find()->all(), 'designation_name', 'designation_name'); ?>
	<?php $technologies=ArrayHelper::map(Technology::find()->all(), 'technology_name', 'technology_name'); ?>

    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->passwordInput(['maxlength' => true])->label('Password') ?>

    <?= $form->field($model, 'email')->input('email') ?>
	
	<?= $form->field($model, 'first_name')->textInput() ?>
	
	<?= $form->field($model, 'last_name')->textInput() ?>
	
	<?= $form->field($model, 'designation')->dropDownList($designations) ?>
	
	<?= $form->field($model, 'technology')->dropDownList($technologies) ?>
	
    <?= $form->field($model, 'status')->radioList(['10' => 'Active', '15' => 'InActive']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
