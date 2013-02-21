<?php
/* @var $this DashboardController */
/* @var $user user */

?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<div class="well well-large profilePanel">
	<div class="row-fluid">
		<div class="span4 userAvatar">
			<?php $this->displayUserAvatar(); ?>
		</div>

		<div class="span8 userInfo">
			<h1><?php echo $user->user_name; ?></h1>
			<?php if ($user->userTwitter) : ?>
				<a href="<?php echo "https://twitter.com/intent/user?user_id=".$user->userTwitter->twitter_id; ?>" class="zocial twitter icon">Twitter</a>
			<?php endif; ?>
			<?php if ($user->userFacebook) : ?>
				<a href="<?php echo "https://www.facebook.com/profile.php?id=".$user->userFacebook->facebook_id; ?>" class="zocial facebook icon">Facebook</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">Dashboard</a>
		<!-- <a class="brand" href="#">Title</a> -->
		<ul class="nav">
			<button type="button" class="btn btn-primary added disabled">Added</button>
			<button type="button" class="btn btn-primary likes">Likes</button>
			<!-- <li class="active added"><a>Added</a></li> -->
			<!-- <li class="likes"><a>Likes</a></li> -->
		</ul>
		<?php echo $this->editProfileButton(); ?>
	</div>
</div>

<?php

$this->loadJs($user->user_name);

$this->addColumnContainer();