<?php
/**
 * _header.php
 *
 */
?>
<?php $this->widget('bootstrap.widgets.TbNavbar',array(
	'type' => 'inverse',
	'brand' => 'Gampic',
	'brandUrl' => '/',
	'collapse' => true,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'items' => array(
				array(
					'label' => 'Categories', 
					'url' => '#', 
					'items' => CMap::mergeArray(
						array(
							array('label' => 'Everything', 'url' => '#'),
							array('label' => 'Popular', 'url' => '#'),
							'---',
						),
						SiteController::gameCategoryMenu()
					),
					// 	array('label' => 'GAMES'),
					// 	array('label' => 'Warcraft', 'url' => '#'),
					// 	array('label' => 'Starcraft', 'url' => '#'),
					// 	array('label' => 'Diablo', 'url' => '#'),
					// ),
				),
				// array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			),
		),
		'<form class="navbar-search pull-left" style="" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'htmlOptions' => array('class' => 'pull-right'),
			'items' => array(
				array(
					'label' => 'Add +',
					'url' => array('/add'),
					'visible' => !Yii::app()->user->isGuest,
				),
				array(
					'label' => 'About', 
					'htmlOptions' => array('data-target' => '#'),
					'items' => array(
						array('label' => 'Info', 'url' => array('/site/page', 'view'=>'info')),
						array('label' => 'Help', 'url' => '#'),
						array('label' => 'Contact', 'url' => array('/site/contact')),
						'---',
						array('label' => 'Copyright', 'url' => '#'),
					),
				),
				array('label' => 'Register', 'url' => array('/register'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Login', 'url' => array('/login'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Logged in as '.Yii::app()->user->name.'('.Yii::app()->user->id.')', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'items' => array(
					array('label' => 'Invite Friends', 'url' => '#'),
					'---',
					array('label' => 'Uploaded', 'url' => '#'),
					array('label' => 'Likes', 'url' => '#'),
					'---',
					array('label' => 'Settings', 'url' => '#'),
					array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
				)),
			),
		),
	),
)); ?>
