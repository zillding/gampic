<?php
/* @var $this SettingsController */
/* @var $model ProfileForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Profile';
?>

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

	<?php echo $form->passwordFieldRow($model, 'user_password', array('placeholder'=>'Password',
																	'class'=>'input-large'));?>

	<?php echo $form->passwordFieldRow($model, 'confirm_user_password', array('placeholder'=>'Confirm Password',
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
		<?php echo $this->twitterConnectButton(); ?>
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
		<?php echo $this->facebookConnectButton(); ?>
	</div>
</div>
