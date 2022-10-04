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
        ['label' => 'Новости', 'url' => ['/news/news'], 'icon' => 'newspaper'],
        [],
        ['label' => 'Категории', 'url' => ['/category/category'], 'icon' => 'list'],
        ['label' => 'Теги', 'url' => ['/tag/tag'], 'icon' => 'comment'],
        [],
        ['label' => 'Комментарии', 'url' => ['/comment/comment'], 'icon' => 'comments'],
        [],
		['label' => 'Пользователи', 'url' => ['/user/index'], 'icon' => 'users'],
        ['label' => 'Типы событий', 'url' => ['/event_type/event-type'], 'icon' => 'calendar'],
        ['label' => 'Места сражений', 'url' => ['/battle_place/battle-place/'], 'icon' => 'circle'],
	]]) ?>
</div>
