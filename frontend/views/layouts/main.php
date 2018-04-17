<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php
$controller = Yii::$app->controller;
$checker = $controller->id.'/'.$controller->action->id;
$mainclass='';
if($checker=='site/index')
{
   $mainclass ='homepage';
}
?>
<body class="<?= $mainclass ?>">
<div id="wrap">
	<?php $this->beginBody() ?>
	<header id="header">
		<section class="container clearfix">
			<div class="logo"><a href="<?php echo Yii::$app->urlManager->createUrl(''); ?>"><img alt="" src="<?php echo Yii::$app->urlManager->createUrl("/frontend/web/images/logo.jpg"); ?>"></a></div>
			<nav class="navigation">
				<?php
				if (Yii::$app->user->isGuest) {
					echo Menu::widget([
						'items' => [
							['label' => 'Home', 'url' => ['site/index']],
							['label' => 'Ask Question', 'url' => ['question/create']],
							['label' => 'Questions', 'url' => ['question/index']],
							['label' => 'Blogs', 'url' => ['wiki/index'], 'items' => [
								['label' => 'Create Blog', 'url' => ['wiki/create']],
							]],	
							['label' => 'Signup', 'url' => ['site/signup'], 'visible' => Yii::$app->user->isGuest], 
							['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],  				       
						],
					]);
				}
				else
				{
					echo Menu::widget([						 
						'items' => [
							['label' => 'Home', 'url' => ['site/index']],
							['label' => 'Ask Question', 'url' => ['question/create']],
							['label' => 'Questions', 'url' => ['question/index']],
							['label' => 'Blogs', 'url' => ['wiki/index'], 'items' => [
								['label' => 'Create Blog', 'url' => ['wiki/create']],
							]],	
							['label' => 'My Dashboard', 'url' => ['user/dashboard'],'items' => [
								['label' => 'Edit Profile', 'url' => ['user/editprofile']],
								['label' => 'Change Password', 'url' => ['user/changepassword']],
								['label' => 'Logout ('.Yii::$app->user->identity->username.')', 'url' => ['site/logout'],'template' => '<a href="{url}" data-method="post">{label}</a>', 'visible' => !Yii::$app->user->isGuest],
							]],					
						],
					]);
				}					
				?>
			</nav>
		</section><!-- End container -->	
	</header>
	<div class="breadcrumbs">
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<h1><?= Html::encode($this->title) ?></h1>
				</div>
				<div class="col-md-12">
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
				</div>
			</div><!-- End row -->
		</section><!-- End container -->
	</div>
	
	
	<div class="section-warp">
			<div class="container clearfix">
			<div class="row">
			<div class="col-md-12">
			<h2>Welcome to Korcomptenz forum</h2>
			<p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque.</p>
			<div class="clearfix"></div>						
			<?php
			if (Yii::$app->user->isGuest) 
			{
				echo Html::a('Join Now', ['site/signup'],['class'=>'signup-btn']);
				echo Html::a('Login', ['site/login'], ['class'=>'login-btn']);
			}
			?>
			</div><!-- End container -->
		</div>
		</div>
	</div>
	
	<section class="container main-content">
		<div class="row">
			<?= Alert::widget() ?>
			<?= $content ?>
		</div>
	</section>
	<footer id="footer-bottom">
		<section class="container">
			<div class="copyrights text-center">&copy; Korcomptenz.com <?= date('Y') ?></div>			
		</section><!-- End container -->
	</footer>
		
	<?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
