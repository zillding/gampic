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
	'clientOptions' => array('validateOnSubmit'=>true),
	'enableAjaxValidation' => true,
	'htmlOptions' => array('class'=>'well'),
)); ?>

	<legend>Gampic - Profile</legend>

	<?php echo $form->errorSummary($model); ?>

	<h4>Account Settings</h4>

	<?php echo $form->textFieldRow($model, 'user_name', array('placeholder'=>'Username',
																'class'=>'input-large'));?>

	<?php echo $form->textFieldRow($model, 'user_email', array('placeholder'=>'Email',
																'class'=>'input-large'));?>

	<?php echo $form->passwordFieldRow($model, 'user_password', array('placeholder'=>'Password',
																	'class'=>'input-large'));?>

	<?php echo $form->passwordFieldRow($model, 'confirm_user_password', array('placeholder'=>'Confirm Password',
																			'class'=>'input-large'));?>

	<h4>Profile Info</h4>

	<?php echo $form->textFieldRow($model, 'user_avatar', array('placeholder'=>'Profile Image',
																'class'=>'input-large'));?>

	<?php echo $form->textFieldRow($model, 'first_name', array('placeholder'=>'First Name',
																'class'=>'input-large'));?>

	<?php echo $form->textFieldRow($model, 'last_name', array('placeholder'=>'Last Name',
																'class'=>'input-large'));?>

	<?php echo $form->radioButtonListRow($model, 'gender', Lookup::items('Gender')); ?>

	<h4>Social Networks</h4>

	<?php echo $form->toggleButtonRow($model, 'connect_with_twitter'); ?>

	<?php echo $form->toggleButtonRow($model, 'connect_with_facebook'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Save', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'cancel','label'=>'Cancel', 'icon'=>'remove'));?>
	</div>


<?php $this->endWidget(); ?>
