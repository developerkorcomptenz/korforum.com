<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $model common\models\ChangePasswordForm */
/* @var $form ActiveForm */
 
$this->title = 'Change Password';
$this->params['breadcrumbs'][] = 'Change Password';
?>
<div class="col-md-9">
	<div class="page-content">
		<div class="page-title"><h2><?= Html::encode($this->title) ?></h2></div>
		<div class="form-style" id="question-submit">
			<p>Please fill out the following fields to change password:</p>
			<?php $form = ActiveForm::begin(); ?> 
				<?= $form->field($model, 'old_password')->passwordInput()->label('Old Password') ?>
				<?= $form->field($model, 'new_password')->passwordInput()->label('New Password') ?>
				<?= $form->field($model, 'confirm_password')->passwordInput() ?>
		 
				<div class="form-group">
					<?= Html::submitButton('Change', ['class' => 'btn btn-primary']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>