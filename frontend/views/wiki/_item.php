<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="wiki-box">
        <div class="col-sm-4">
            <div class="wiki-image">
                <?php
                $url = Yii::$app->request->hostInfo; ?>
                <div class="text-center">
                    <div class="row">
                        <img src="<?php echo $url."/korforum.com/backend/web/images/". $model->featured_image ;?>" alt="<?php echo $model->featured_image ;?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="wiki-title">
                <h2><?php echo $model->title; ?></h2>
            </div>
            <div class="wiki-teaser">
                <?php echo $model->teaser; ?>
            </div>
            <div class="wiki-read-more">
                <?= Html::a('Read More', ['wiki/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
            <p>

            </p>
        </div>
    </div>
</div>
