<?php
/* @var $this AllController */

$this->pageTitle = Yii::app()->name; // set the title of the page

if (Yii::app()->user->isGuest) {
	$this->addBanner();
}

$this->addColumnContainer();

?>