<?php
/* @var $this SiteController */

$this->pageTitle=app()->name . ' - Copyright';

?>

<div class="well well-large">
<?php
// use the markdown file to populate the content
echo mh('
Copyright &copy; 2013 by Ding Zeyu

All rights reserved.

Developed in Nanyang Technological University
');
?>
</div>
