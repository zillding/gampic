<?php
/* @var $this SiteController */

$this->pageTitle=app()->name . ' - Help';

// use the markdown file to populate the content
echo mh(file_get_contents(dirname(__FILE__).'/help.md'));

// $this->loadDisqus();

?>