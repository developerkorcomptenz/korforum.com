<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Wiki */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Wikis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/*echo "<pre>";
print_r($model);*/
?>
<div class="row">
    <div class="col-sm-8">
            <div class="wiki-view">
                <div class="wiki-title">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                By <?php echo $model->user->username;?> , Posted on: <?php echo Yii::$app->formatter->asDate($model->created_at);?>
                <div class="wiki-image">
                    <?php
                    $url = Yii::$app->request->hostInfo; ?>
                    <div class="text-center">
                        <div class="row">
                            <img src="<?php echo $url."/korforum.com/backend/web/images/". $model->featured_image ;?>" alt="<?php echo $model->featured_image ;?>" />
                        </div>
                    </div>
                </div>
                <div class="wiki-content">
                    <?php echo $model->content; ?>
                </div>
                <?php //print_r($model);
                //exit;?>
            </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>