<?php
/**
 * main.php
 *
 */
?>
<!DOCTYPE html>

<?php $this->renderPartial('//layouts/_htmlHead'); ?>

<body>
<div class="container" id="page">

	<?php $this->renderPartial('//layouts/_header') ?>

	<div class="container" style="margin-top:80px">
		<?php 
			echo $content; 
		?>
	</div>

	<?php $this->renderPartial('//layouts/_footer'); ?>

</div>

<a class="scrollToTop"></a>

<?php $this->renderPartial('//layouts/_footerScripts'); ?>

</body>
</html>