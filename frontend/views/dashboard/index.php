<?php
/* @var $this DashboardController */
/* @var $user user */

?>

<div class="well well-large profilePanel">
	<div class="row-fluid">
		<div class="span4 userAvatar">
			<?php $this->displayUserAvatar(); ?>
		</div>

		<div class="span8 userInfo">
			<h1><?php echo $user->user_name; ?></h1>
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