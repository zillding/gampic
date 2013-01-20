<?php
/* @var $this AllController */

$this->pageTitle = Yii::app()->name; // set the title of the page

?>

<div class="banner">
	<ul class="scroller">
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/diablo3.jpg" width="482" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/warcraft_1.jpg" width="333" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/starcraft_1.jpg" width="364" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/warcraft_2.jpg" width="213" height="250"></li>
		<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/starcraft_2.jpg" width="375" height="250"></li>
	</ul>
</div>

<!-- <h1><?php echo $this->id . '/' . $this->action->id; ?></h1> -->

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<?php

$this->renderPartial('//columnContainer/index');

?>