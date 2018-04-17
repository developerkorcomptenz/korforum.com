<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Category;
use common\models\Wiki;

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
<div class="col-sm-9">
	<article class="post single-post clearfix">
	<div class="post-inner">
		<div class="post-img">
			<?= Html::a('<img src="'.Yii::$app->urlManager->createUrl("/backend/web/images/". $model->featured_image).'" alt="">', ['wiki/view', 'id' => $model->id]) ?>
		</div>
		<h2 class="post-title"><?= Html::a($model->title, ['wiki/view', 'id' => $model->id]) ?></h2>
		<div class="blog-actions">
			<?php
			if($model->user_id == $user_id)
			{
				?>
				<?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'action-edit']) ?>
				<?= Html::a('Delete', ['delete', 'id' => $model->id], [
					'class' => 'action-delete',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				]) ?>
				<?php
			}
			?>
		</div>
		<div class="post-meta">
			<div class="meta-author"><span class="glyphicon glyphicon-user"></span> <?= Html::a(ucfirst($model->user->username), ['user/view', 'id' => $model->user->id]) ?></div>
			<div class="meta-date"><span class="glyphicon glyphicon-calendar"></span> <?php echo date("F m,Y",strtotime($model->created_at)); ?></div>
		</div>
		<div class="post-content">
			<?php echo $model->content; ?>
		</div><!-- End post-content -->		
		<div class="clearfix"></div>
	</div><!-- End post-inner -->
	</article>
</div>				
<?= $this->render('..\site\sidebar') ?>