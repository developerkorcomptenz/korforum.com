<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

if(empty($model->status)){
	$model->status = "10";
}
?>

<div class="user-form">
	

    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->hiddenInput(['maxlength' => true])->label('') ?>

    <?= $form->field($model, 'password_reset_token')->hiddenInput(['maxlength' => true])->label('') ?>

    <?= $form->field($model, 'email')->input('email') ?>
	
	<?= $form->field($model, 'first_name')->textInput() ?>
	
	<?= $form->field($model, 'last_name')->textInput() ?>
	
	<?= $form->field($model, 'designation')->textInput() ?>
	
	<?= $form->field($model, 'technology')->textInput() ?>
	
    <?= $form->field($model, 'status')->radioList(['10' => 'Active', '15' => 'InActive']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
