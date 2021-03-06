<?php
/**
 * _htmlHead.php
 *
 */
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="description" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- for facebook -->
	<meta property="og:title" content="Gampic" />
	<meta property="og:type" content="game" />
	<meta property="og:url" content="http://gampic.com" />
	<meta property="og:image" content="" />
	<meta property="og:site_name" content="Gampic" />
	<meta property="fb:admins" content="100000136341114" />
	<meta property="fb:app_id" content="443841368996612"/>

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="<?php echo r()->baseUrl; ?>/images/favicon.ico">

	<link rel="stylesheet" href="<?php echo r()->baseUrl; ?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo r()->baseUrl; ?>/css/main.css">
	<script src="<?php echo r()->baseUrl; ?>/js/modernizr-2.6.2.js"></script>

	<title><?php echo h($this->pageTitle); /* using shortcut for CHtml::encode */ ?></title>
</head>
