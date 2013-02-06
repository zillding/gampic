<?php
/* @var $this SiteController */

$this->pageTitle=app()->name . ' - Info';

// use the markdown file to populate the content
echo mh(file_get_contents(dirname(__FILE__).'/info.md'));

$this->loadDisqus();

?>