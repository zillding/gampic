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
							array('label' => 'Everything', 'url' => array('/all/show', 'category' => 'all')),
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
					'visible' => !user()->isGuest,
				),
				array(
					'label' => 'About', 
					'htmlOptions' => array('data-target' => '#'),
					'items' => array(
						array('label' => 'Info', 'url' => array('/site/page', 'view'=>'info')),
						array('label' => 'Help', 'url' => array('/site/page', 'view'=>'help')),
						array('label' => 'Contact', 'url' => array('/site/contact')),
						'---',
						array('label' => 'Terms of Service', 'url' => array('/site/page', 'view'=>'terms')),
						array('label' => 'Copyright', 'url' => array('/site/page', 'view'=>'copyright')),
					),
				),
				array('label' => 'Register', 'url' => array('/register'), 'visible' => user()->isGuest),
				array('label' => 'Login', 'url' => array('/login'), 'visible' => user()->isGuest),
				array('label' => 'Logged in as '.user()->name.'('.user()->id.')',
					'visible' => !user()->isGuest,
					'items' => array(
						array('label' => 'Invite Friends', 'url' => '#'),
						'---',
						array('label' => 'Uploaded', 'url' => '#'),
						array('label' => 'Likes', 'url' => '#'),
						'---',
						array('label' => 'Settings', 'url' => '#'),
						array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !user()->isGuest),
					)
				),
			),
		),
	),
));
?>
