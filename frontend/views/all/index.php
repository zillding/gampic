<?php
/* @var $this AllController */

$this->pageTitle = app()->name; // set the title of the page

if (user()->isGuest) {
	$this->addBanner();
}

$this->addColumnContainer();

?>