<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = "My Profile: ".ucfirst($model->username);
$this->params['breadcrumbs'][] = $this->title;
$user_id='';
if(Yii::$app->user->identity)
{
	$user_id=Yii::$app->user->identity->id;
}
?>

<div class="col-md-9">
	<div class="row">
		<div class="user-profile">
			<div class="col-md-12">
				<div class="page-content">
					<h2><?php echo ucfirst($model->username); ?></h2>
					<div class="user-profile-img">
						<img alt="" src="<?php echo Yii::$app->urlManager->createUrl("/frontend/web/images/avatar.png"); ?>">
					</div>
					<div class="ul_list about-user">
						<ul>
							<li>First Name : <span><?php echo ucfirst($model->first_name); ?></span></li>
							<li>Last Name : <span><?php echo ucfirst($model->last_name); ?></span></li>
							<li>Designation : <span><?php echo ucfirst($model->designation); ?></span></li>
							<li>Register Date : <span><?php echo date("F m,Y",$model->created_at); ?></span></li>
						</ul>
					</div>
				</div>
			</div>	
			<div class="col-md-12">
				<div class="page-content-2">
					<h2>Blogs</h2>
					<div class="ul_list">
						<?php
						if($model->wikis)
						{
							foreach($model->wikis as $wiki)
							{
								?>
								<article class="post clearfix">
									<div class="post-inner">
										<h2 class="post-title">
											<?= Html::a($wiki->title, ['wiki/view', 'id' => $wiki->id]) ?>
										</h2>
										<div class="blog-actions">
										<?php
										if($wiki->user_id == $user_id)
										{
											?>
											<?= Html::a('Edit', ['wiki/update', 'id' => $wiki->id], ['class' => 'action-edit']) ?>
											<?= Html::a('Delete', ['wiki/delete', 'id' => $wiki->id], [
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
											<div class="meta-author"><span class="glyphicon glyphicon-user"></span> <?= Html::a(ucfirst($wiki->user->username), ['user/view', 'id' => $wiki->user->id]) ?></div>
											<div class="meta-date"><span class="glyphicon glyphicon-calendar"></span> <?php echo date("F m,Y",strtotime($wiki->created_at)); ?></div>
										</div>
										<div class="post-content">
											<p><?php echo $wiki->teaser; ?></p>
											<?= Html::a('<span class="glyphicon glyphicon-plus"></span> Continue reading', ['wiki/view', 'id' => $wiki->id], ['class' => 'post-read-more button color small']) ?>	
										</div><!-- End post-content -->
									</div><!-- End post-inner -->
								</article><!-- End article.post -->	
								<?php
							}
						}
						else
						{
							?><div class="site-error"><div class="alert alert-warning">No records found!.</div></div><?php
						}
						?>						
					</div>
				</div>
			</div>	
			<div class="col-md-12">
				<div class="page-content-2">
					<h2>Questions</h2>
					<div class="ul_list">
						<?php
						if($model->questions)
						{
							foreach($model->questions as $question)
							{
								?>
								<article class="question user-question">
									<h3><?= Html::a($question->question_title, ['question/view', 'id' => $question->id]) ?></h3>
									<div class="question-actions">
										<?php
										if($question->user_id == $user_id)
										{
											?>
											<?= Html::a('Edit', ['question/update', 'id' => $question->id], ['class' => 'action-edit']) ?>
											<?= Html::a('Delete', ['question/delete', 'id' => $question->id], [
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
									<div class="question-content">
										<div class="question-bottom">
											<div class="question-category">
												<span class="glyphicon glyphicon-folder-close"></span>
												<?= Html::a($question->category->category_name, ['category/view', 'id' => $question->category_id]) ?>
											</div>
											<div class="question-date">
												<span class="glyphicon glyphicon-calendar"></span>
												<?php
												if($question->created_date==$question->modified_date)
												{
													echo "asked ".Yii::$app->formatter->format(strtotime($question->created_date), 'relativeTime');  
												}
												else
												{
													echo "modified ".Yii::$app->formatter->format(strtotime($question->modified_date), 'relativeTime');  
												}
												?>
											</div>
											<div class="question-comment">
												<span class="glyphicon glyphicon-comment"></span>
												<?php echo count($question->answers). " Answer"; ?>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</article>
								<?php
							}
						}
						else
						{
							?><div class="site-error"><div class="alert alert-warning">No records found!.</div></div><?php
						}
						?>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->render('..\site\sidebar') ?>				
