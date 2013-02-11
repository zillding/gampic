<?php
/* @var $this TwitterController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle = app()->name;

?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'register-form',
	'action' => $this->createUrl('register'),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<legend>Create Your Accout</legend>

	<p class="text-info"><span class="label label-success">Success</span> Connected to Twitter as <strong><?php echo $_SESSION['access_token']['screen_name']; ?></strong></p><br>

	<?php echo $form->errorSummary($model); ?>

	<div class='control-group'>
	<?php echo $form->textFieldRow($model, 'user_name', array('labelOptions'=>array('label'=>false),
																'placeholder'=>'Username',
																'class'=>'input-large'));?>
	</div>

	<div class='control-group'>
	<?php echo $form->textFieldRow($model, 'user_email', array('labelOptions'=>array('label'=>false),
																'placeholder'=>'Email',
																'class'=>'input-large'));?>
	</div>

	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'user_password', array('labelOptions'=>array('label'=>false),
																	'placeholder'=>'Password',
																	'class'=>'input-large'));?>
	</div>

	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'confirm_user_password', array('labelOptions'=>array('label'=>false),
																			'placeholder'=>'Confirm Password',
																			'class'=>'input-large'));?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Create Accout', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'Reset', 'icon'=>'pencil'));?>
	</div>

<?php $this->endWidget(); ?>

