<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
	<div class="reset-form">
		<div class="page-content">		
			<h2><?= Html::encode($this->title) ?></h2>	
			<div class="form-style">
				<p>Please choose your new password:</p> 
				<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

					<?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

					<div class="form-group">
						<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>