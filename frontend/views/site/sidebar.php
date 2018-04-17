<?php
use yii\helpers\Html;
use common\models\Category;
use common\models\Wiki;
use common\models\User;
?>
<aside class="col-md-3 sidebar">
	<div class="widget category-widget">
		<h3 class="widget_title">Categories</h3>
		<div class="ul_list">
		<?php
			$categories=Category::find()->all();
			if($categories)
			{
				echo "<ul>";
				foreach($categories as $category)
				{
					?>
					<li> 
						<?= Html::a($category->category_name, ['category/view', 'id' => $category->id]) ?> 
						<span class="badge pull-right"> <?php echo count($category->questions); ?></span>
					</li>
					<?php
				}
				echo "</ul>";
			}
		?>
		</div>
	</div>
	<div class="widget blogs-widget">
		<h3 class="widget_title">Recent Blogs</h3>
		<?php
			$blogs=Wiki::find()->orderBy(['created_at'=>SORT_DESC])->limit(5)->all();
			if($blogs)
			{
				echo "<ul class='related-posts'>";
				foreach($blogs as $blog)
				{
					?>
					<li class="related-item">
						<h3><?= Html::a($blog->title, ['wiki/view', 'id' => $blog->id]) ?></h3>
						<div class="clear"></div>
						<span><?php echo date("F m,Y",strtotime($blog->created_at)); ?></span>
					</li>
					<?php
				}
				echo "</ul>";
			}
			?>
	</div>
	<div class="widget users-widget">
		<h3 class="widget_title">Recent Users</h3>
		<?php
			$users=User::find()->orderBy(['created_at'=>SORT_DESC])->limit(5)->all();
			if($users)
			{
				echo "<ul class='related-posts'>";
				foreach($users as $user)
				{
					?>
					<li class="related-item">
						<h3><?= Html::a(ucfirst($user->username), ['user/view', 'id' => $user->id]) ?></h3>
						<div class="clear"></div>
						<span><?php echo date("F m,Y",$user->created_at); ?></span>
					</li>
					<?php
				}
				echo "</ul>";
			}
			?>
	</div>
</aside>