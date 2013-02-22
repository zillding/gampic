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

	<?php echo $form->textFieldRow($model, 'user_avatar', array('placeholder'=>'Profile Image',
																'value'=>$model->user_avatar,
																'class'=>'input-large'));?>

	<?php echo $form->textFieldRow($model, 'first_name', array('placeholder'=>'First Name',
																'valud'=>$model->first_name,
																'class'=>'input-large'));?>

	<?php echo $form->textFieldRow($model, 'last_name', array('placeholder'=>'Last Name',
																'value'=>$model->last_name,
																'class'=>'input-large'));?>

	<?php echo $form->radioButtonListRow($model, 'gender', Lookup::items('Gender')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Save', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'cancel','label'=>'Cancel', 'icon'=>'remove'));?>
	</div>

<?php $this->endWidget(); ?>

<div class="password well">
	<h4>Password Settings</h4>
	<?php if ($this->user->userGampic): ?>
		<a href="/settings/changepassword" class="btn btn-danger changePassword">Change Password</a>
	<?php else: ?>
		<a href="/settings/createpassword" class="btn btn-danger createPassword">Create Password</a>
	<?php endif; ?>
</div>

<div class="social-connection well">
	<h4>Social Networks</h4>

	<div class="profile-row connect-with-twitter">
		Connect with <strong>Twitter</strong>: 
		<span class="twitter-connection-status">
			<?php if ($this->connectToTwitter): ?>
				<span class="label label-success">Connected</span>
			<?php else: ?>
				<span class="label label-important">Not Connected</span>
			<?php endif; ?>
		</span>
		<span class="buttonHolder">
			<?php echo $this->twitterConnectButton(); ?>
		</span>
	</div>

	<div class="profile-row connect-with-facebook">
		Connect with <strong>Facebook</strong>: 
		<span class="facebook-connection-status">
			<?php if ($this->connectToFacebook): ?>
				<span class="label label-success">Connected</span>
			<?php else: ?>
				<span class="label label-important">Not Connected</span>
			<?php endif; ?>
		</span>	
		<span class="buttonHolder">
			<?php echo $this->facebookConnectButton(); ?>
		</span>
	</div>
</div>
