<?php
/**
 * _header.php
 *
 */
?>
<?php 
$this->widget('bootstrap.widgets.TbNavbar',array(
	'type' => 'inverse',
	'brand' => 'Gampic',
	'brandUrl' => '/',
	'collapse' => true,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'htmlOptions' => array('class' => 'pull-left'),
			'items' => array(
				// array('label' => 'Home',
				// 	'url' => array('/'),
				// 	'active' => true,
				// ),
				array(
					'label' => 'Categories', 
					'htmlOptions' => array('data-target' => '#'),
					'items' => CMap::mergeArray(
						array(
							array('label' => 'Everything', 'url' => array('/all/show')),
							array('label' => 'Popular', 'url' => '#'),
							'---',
						),
						AllController::gameCategoryMenu()
					),
				),
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
						array('label' => 'info', 'url' => array('/site/page', 'view'=>'info')),
						array('label' => 'help', 'url' => '#'),
						array('label' => 'contact', 'url' => array('/site/contact')),
						'---',
						array('label' => 'copyright', 'url' => '#'),
					),
				),
				array('label' => 'Register', 'url' => array('/register'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Login', 'url' => array('/login'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Logged in as '.Yii::app()->user->name.'('.Yii::app()->user->id.')',
					'visible' => !Yii::app()->user->isGuest,
					'items' => array(
						array('label' => 'Invite Friends', 'url' => '#'),
						'---',
						array('label' => 'Uploaded', 'url' => '#'),
						array('label' => 'Likes', 'url' => '#'),
						'---',
						array('label' => 'Settings', 'url' => '#'),
						array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
					)
				),
			),
		),
	),
));
?>
