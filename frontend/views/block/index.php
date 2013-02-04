<?php
/* 
 *
 * @var $this BlockController 
 * @var $model Block
 * 
*/

?>

<div class="block">
	<div class="topButtonArea">
		<button class="btn btn-small topButtons shareButton" data-id="<?php echo $model->imageId; ?>"><i class="icon-share"></i> Share</button>
		<?php $model->displayLikeButton(); ?>
	</div>
	<div class="blockHolder" style="height: <?php echo $model->thumbHeight; ?>px">
		<a href="<?php echo Yii::app()->params['originalImageDir'].'/'.$model->imageId.'.'.$model->extension; ?>" class="imgLink bigImgLink fancybox" title="<?php echo $model->title; ?>">
			<img alt="<?php echo $model->imageId; ?>" src="<?php echo Yii::app()->params['thumbnailImageDir'].'/'.$model->imageId.'.'.$model->extension; ?>" />
		</a>
	</div>
	<p class="description"><?php echo $model->title; ?></p>
	<p class="status">
		<span class="likeCount"><?php echo $model->likes; ?></span> like(s)
	</p>
	<?php $model->displayCommentSection(); ?>
</div>
