<?php

use yii\helpers\Html;
use common\models\Category;
use common\models\Wiki;

/* @var $this yii\web\View */
/* @var $model backend\models\Wiki */

$this->title = 'Create Blog';
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-9">
	<div class="page-content">
		<div class="page-title"><h2><?= Html::encode($this->title) ?></h2></div>
		<div class="form-style" id="question-submit">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>
	</div>
</div>
<?= $this->render('..\site\sidebar') ?>