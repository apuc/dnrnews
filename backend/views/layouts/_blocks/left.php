<?php

use andrewdanilov\adminpanel\widgets\Menu;

/* @var $this \yii\web\View */
/* @var $siteName string */
/* @var $directoryAsset false|string */

?>

<div class="page-left">
	<div class="sidebar-heading"><?= $siteName ?></div>
	<?= Menu::widget(['items' => [
		['label' => 'System'],
		['label' => 'Users', 'url' => ['/user/index'], 'icon' => 'users'],
        [],
		['label' => 'News', 'url' => ['/news/news'], 'icon' => 'newspaper'],
        ['label' => 'Category', 'url' => ['/category/category'], 'icon' => 'list'],
		['label' => 'Tags', 'url' => ['/tag/tag'], 'icon' => 'comment'],
		['label' => 'Comment', 'url' => ['/comment/comment'], 'icon' => 'comments'],
	]]) ?>
</div>
