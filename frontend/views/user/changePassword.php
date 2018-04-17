<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $model frontend\models\ChangePasswordForm */
/* @var $form ActiveForm */
 
$this->title = 'Change Password';
$this->params['breadcrumbs'][] = 'Change Password';
?>
<div class="col-md-9">
	<div class="page-content">
		<div class="page-title"><h2><?= Html::encode($this->title) ?></h2></div>
		<div class="form-style" id="question-submit">
			<?php $form = ActiveForm::begin(); ?> 
				<?= $form->field($model, 'password')->passwordInput()->label('New Password') ?>
				<?= $form->field($model, 'confirm_password')->passwordInput() ?>
		 
				<div class="form-group">
					<?= Html::submitButton('Change', ['class' => 'btn btn-primary']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
<?= $this->render('..\site\sidebar') ?>