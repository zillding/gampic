<?php
/* @var $this SiteController */

$this->pageTitle=app()->name . ' - Terms of Service';

?>

<div class="well well-large">
<?php
// use the markdown file to populate the content
echo mh('
#Thank you for using Gampic#
	
---

###1. Using Gampic###

###2. Your Content###

###3. Copyright Policy###

###4. Security###

###5. General Terms###

');
?>
</div>
