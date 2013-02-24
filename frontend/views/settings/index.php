<?php
/* @var $this SettingsController */
/* @var $model ProfileForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Profile';
?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'profile-form',
	'type' => 'horizontal',
	'action' => $this->createUrl('save'),
	'enableClientValidation' => true,
	// 'clientOptions' => array('validateOnSubmit'=>true),
	'enableAjaxValidation' => true,
	'htmlOptions' => array('class'=>'well'),
)); ?>

	<legend>Gampic - Profile</legend>

	<?php echo $form->errorSummary($model); ?>

	<h4>Account Settings</h4>

	<?php echo $form->textFieldRow($model, 'user_name', array('placeholder'=>'Username',
																'value'=>$model->user_name,
																'class'=>'input-large'));?>

	<?php echo $form->textFieldRow($model, 'user_email', array('placeholder'=>'Email',
																'value'=>$model->user_email,
																'class'=>'input-large'));?>

	<h4>Profile Info</h4>

	<?php echo $form->textFieldRow($model, 'first_name', array('placeholder'=>'First Name',
																'valud'=>$model->first_name,
																'class'=>'input-large'));?>

	<?php echo $form->textFieldRow($model, 'last_name', array('placeholder'=>'Last Name',
																'value'=>$model->last_name,
																'class'=>'input-large'));?>

	<?php echo $form->radioButtonListRow($model, 'gender', Lookup::items('Gender')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Save', 'icon'=>'ok', 'size'=>'large'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'cancel','label'=>'Cancel', 'icon'=>'remove','url'=>'/dashboard','size'=>'large'));?>
	</div>

<?php $this->endWidget(); ?>

<div class="profileImage well">
	<h4>Profile Image</h4>
	<div class="row">
		<div class="span3">
			<?php $size = 120; echo img($this->user->user_avatar, $this->user->user_name, $size, $size, array('class'=>'img-polaroid')); ?>
		</div>

		<div class="span3">

			<div class="getGravatarImage buttonHolder">
				<button class="btn btn-primary">Get from Gravatar</button>
			</div>
			<?php $this->renderPartial("_getProfileImage", array("serviceName"=>"Gravatar")); ?>

			<?php if ($this->user->userTwitter): ?>
			<div class="getTwitterImage buttonHolder">
				<button class="btn btn-primary getTwitterImage">Get from Twitter</button>
			</div>
			<?php $this->renderPartial("_getProfileImage", array("serviceName"=>"Twitter")); ?>
			<?php endif; ?>

			<?php if ($this->user->userFacebook): ?>
			<div class="getFacebookImage buttonHolder">
				<button class="btn btn-primary getFacebookImage">Get from Facebook</button>
			</div>
			<?php $this->renderPartial("_getProfileImage", array("serviceName"=>"Facebook")); ?>
			<?php endif; ?>

		</div>
			
	</div>

</div>

<div class="password well">
	<div class="row">
		<div class="span3">
			<h4>Password Settings</h4>
		</div>
		<div class="span3">
			<?php if ($this->user->userGampic): ?>
				<a href="/settings/changepassword" class="btn btn-danger changePassword">Change Password</a>
			<?php else: ?>
				<a href="/settings/createpassword" class="btn btn-danger createPassword">Create Password</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="social-connection well">
	<h4>Social Networks</h4>

	<div class="row profile-row connect-with-twitter">
		<div class="span3">
			Connect with <strong>Twitter</strong>: 
		</div>
		<div class="span3 twitter-connection-status">
			<?php if ($this->connectToTwitter): ?>
				<span class="label label-success">Connected</span>
			<?php else: ?>
				<span class="label label-important">Not Connected</span>
			<?php endif; ?>
		</div>
		<span class="span3 buttonHolder">
			<?php echo $this->twitterConnectButton(); ?>
		</span>
	</div>

	<div class="row profile-row connect-with-facebook">
		<div class="span3">
			Connect with <strong>Facebook</strong>: 
		</div>
		<div class="span3 facebook-connection-status">
			<?php if ($this->connectToFacebook): ?>
				<span class="label label-success">Connected</span>
			<?php else: ?>
				<span class="label label-important">Not Connected</span>
			<?php endif; ?>
		</div>	
		<div class="span3 buttonHolder">
			<?php echo $this->facebookConnectButton(); ?>
		</div>
	</div>
</div>
