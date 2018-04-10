<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

/* @var $this yii\web\View */
/* @var $model backend\models\Wiki */
/* @var $form yii\widgets\ActiveForm */
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
$model->user_id = Yii::$app->user->identity;

?>

<div class="wiki-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label('') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teaser')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'basic']) ?>

    <?php /*echo $form->field($model, 'featured_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); */ ?>
    <?php
    if (empty($model->featured_image)) {
    echo $form->field($model, 'featured_image')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    ]);
    }
    else {
        //echo $model->featured_image;
        $WikiImage = Yii::$app->request->hostInfo."/korforum.com/backend/web/images/". $model->featured_image;
        echo $form->field($model, 'featured_image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'image',
                'showUpload' => false,
                'initialPreview'=> [
                    '<img src="'.$WikiImage.'" class="file-preview-image">',
                ],
                'initialCaption'=> $model->title,
            ],
        ]);
    ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
