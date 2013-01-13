<?php
/**
 * main.php
 *
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/normalize.css">
	
	<!-- Use the .htaccess and remove these lines to avoid edge case issues. More info: h5bp.com/b/378 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css"/>
	<!--using less instead? file not included-->
	<!--<link rel="stylesheet/less" type="text/css" href="/less/styles.less">-->

	<!-- create your own: http://modernizr.com/download/-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr-2.6.2.js"></script>

	<!-- blueprint CSS framework -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->


	<!--<script src="/less/less-1.3.0.min.js"></script>-->
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
	<title><?php echo h($this->pageTitle); /* using shortcut for CHtml::encode */ ?></title>

	<style type="text/css">
		ul.nav li.dropdown:hover ul.dropdown-menu{
		    display: block;    
		}
	</style>

</head>

<body>
<div class="container" id="page">

	<?php $this->widget('bootstrap.widgets.TbNavbar',array(
		'type' => 'inverse',
		'brand' => 'Gampic',
		'brandUrl' => '/',
		'collapse' => true,
		'items'=>array(
			array(
				'class' => 'bootstrap.widgets.TbMenu',
				'items' => array(
					array(
						'label' => 'Categories', 
						'url' => '#', 
						'items' => array(
							array('label' => 'Everything', 'url' => '#'),
							array('label' => 'Popular', 'url' => '#'),
							'---',
							array('label' => 'GAMES'),
							array('label' => 'Warcraft', 'url' => '#'),
							array('label' => 'Starcraft', 'url' => '#'),
							array('label' => 'Diablo', 'url' => '#'),
						),
					),
					// array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				),
			),
			'<form class="navbar-search pull-left" style="" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
			array(
				'class' => 'bootstrap.widgets.TbMenu',
				'htmlOptions' => array('class' => 'pull-right'),
				'items' => array(
					array('label'=>'Upload', 'url'=>array('/site/upload'), 'visible'=>!Yii::app()->user->isGuest),
					array('---', 'visible' => !Yii::app()->user->isGuest),
					// '---',
					array(
						'label' => 'About', 
						'url' => array('/site/page', 'view' => 'about'),
						'htmlOptions' => array('data-target' => '#'),
						'items' => array(
							array('label' => 'Help', 'url' => '#'),
							array('label'=>'Contact', 'url'=>array('/site/contact')),
							'---',
							array('label' => 'Copyright', 'url' => '#'),
						),
					),
					array('label'=>'Register', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label' => 'Logged in as '.Yii::app()->user->name.'('.Yii::app()->user->id.')', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'items' => array(
						array('label' => 'Invite Friends', 'url' => '#'),
						'---',
						array('label' => 'Uploaded', 'url' => '#'),
						array('label' => 'Likes', 'url' => '#'),
						'---',
						array('label' => 'Settings', 'url' => '#'),
						array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
					)),
				),
			),
		),
	)); ?>

	<!-- mainmenu -->
	<div class="container" style="margin-top:80px">
		<?php 
			// if (isset($this->breadcrumbs))
			// 	$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			// 		'links' => $this->breadcrumbs,
			// 	)); //breadcrumbs

			echo $content; 
		?>
		<!-- <hr/> -->
		<div id="footer">
			<!-- Copyright &copy; <?php echo date('Y'); ?>.<br/> -->
			<!-- All Rights Reserved.<br/> -->
		</div>
		<!-- footer -->
	</div>

</div>

<!-- Google Analytics -->
<script>
	var _gaq=[['_setAccount','<?php echo param('google.analytics.account'); // check global.php shortcut file at "common/lib/" ?>'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>