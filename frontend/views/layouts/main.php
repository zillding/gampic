<?php
/**
 * main.php
 * $this the controller which changes according to the context
 *
 */
?>
<!DOCTYPE html>

<?php $this->renderPartial('//layouts/_htmlHead'); ?>

<body>
<div class="container" id="page">

	<?php $this->renderPartial('//layouts/_header') ?>

	<div class="container" style="margin-top:60px">
		<?php 
			echo $content; 
		?>
	</div>

	<?php $this->renderPartial('//layouts/_footer'); ?>

</div>

<a class="scrollToTop"></a>

<?php $this->renderPartial('//layouts/_footerScripts'); ?>

<?php SiteController::addDisqusSupport(); ?>

</body>
</html>