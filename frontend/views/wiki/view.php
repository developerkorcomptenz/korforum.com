<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Wiki */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user_id='';
if(Yii::$app->user->identity)
{
	$user_id=Yii::$app->user->identity->id;
}
?>
<div class="row">
    <div class="col-sm-8">
            <div class="wiki-view">
                <div class="wiki-title">
                    <h1><?= Html::encode($this->title) ?></h1>
					<div class="question-actions text-right">
						<?php
						if($model->user_id == $user_id)
						{
							?>
							<?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
							<?= Html::a('Delete', ['delete', 'id' => $model->id], [
								'class' => 'btn btn-danger',
								'data' => [
									'confirm' => 'Are you sure you want to delete this item?',
									'method' => 'post',
								],
							]) ?>
							<?php
						}
						?>
					</div>
                </div>
                By <?php echo $model->user->username;?> , Posted on: <?php echo Yii::$app->formatter->asDate($model->created_at);?>
                <div class="wiki-image">                
                    <div class="text-center">
                        <div class="row">
                            <img src="<?php echo Yii::$app->urlManager->createUrl("/backend/web/images/". $model->featured_image); ?>" alt="<?php echo $model->featured_image ;?>" />
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