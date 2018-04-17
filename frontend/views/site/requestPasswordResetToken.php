<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
	<div class="reset-form">
		<div class="page-content">		
			<h2><?= Html::encode($this->title) ?></h2>	
			<div class="form-style">
				<p>Please fill out your email. A link to reset password will be sent there.</p>    
				<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

					<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

					<div class="form-group">
						<?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
					</div>

				<?php ActiveForm::end(); ?>
			</div>
        </div>
    </div>
</div>
