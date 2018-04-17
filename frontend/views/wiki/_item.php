<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<article class="post blog_2 clearfix">
	<div class="post-inner">
		<h2 class="post-title">
			<?= Html::a($model->title, ['wiki/view', 'id' => $model->id]) ?>
		</h2>
		<div class="post-img">
			<?= Html::a('<img src="'.Yii::$app->urlManager->createUrl("/backend/web/images/". $model->featured_image).'" alt="">', ['wiki/view', 'id' => $model->id]) ?>
		</div>
		<div class="post-meta">
			<div class="meta-author"><span class="glyphicon glyphicon-user"></span> <?= Html::a(ucfirst($model->user->username), ['user/view', 'id' => $model->user->id]) ?></div>
			<div class="meta-date"><span class="glyphicon glyphicon-calendar"></span> <?php echo date("F m,Y",strtotime($model->created_at)); ?></div>
		</div>
		<div class="post-content">
			<p><?php echo $model->teaser; ?></p>
			<?= Html::a('<span class="glyphicon glyphicon-plus"></span> Continue reading', ['wiki/view', 'id' => $model->id], ['class' => 'post-read-more button color small']) ?>	
		</div><!-- End post-content -->
	</div><!-- End post-inner -->
</article><!-- End article.post -->