<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Technology */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="technology-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'technology_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'created_date')->textInput() ?>

    <?php //$form->field($model, 'modified_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
