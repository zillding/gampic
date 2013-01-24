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
	<div class="blockHolder">
		<a href="/images/upload/orig/<?php echo $model->imageId.'.'.$model->extension; ?>" rel="lightbox" class="imgLink bigImgLink" title="<?php echo $model->title; ?>">
			<img alt="<?php echo $model->imageId; ?>" src="/images/upload/thumb/<?php echo $model->imageId.'.'.$model->extension; ?>" class="" height="<?php echo $model->thumbHeight; ?>" />
		</a>
	</div>
	<p class="description"><?php echo $model->title; ?></p>
	<p class="status">
		<span class="likeCount"><?php echo $model->likes; ?></span> like(s)
	</p>
	<?php $model->displayCommentSection(); ?>
</div>
