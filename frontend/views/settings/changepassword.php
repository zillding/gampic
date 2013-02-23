<?php
/* @var $this SettingsController */
/* @var $model ChangepasswordForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name;
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'changepassword-form',
	'type' => 'horizontal',
	'action' => $this->createUrl('changepassword'),
	'enableClientValidation'=>true,
	// 'clientOptions' => array('validateOnSubmit'=>true),
	// 'enableAjaxValidation' => true,
	'htmlOptions' => array('class'=>'well'),
)); ?>

	<legend>Gampic - Change Password</legend>

	<?php echo $form->errorSummary($model); ?>

	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'old_password', array('placeholder'=>'Password',
																	'class'=>'input-large'));?>
	</div>

	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'new_password', array('placeholder'=>'Password',
																	'class'=>'input-large'));?>
	</div>

	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'confirm_new_password', array('placeholder'=>'Confirm Password',
																			'class'=>'input-large'));?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Save', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'Reset', 'icon'=>'pencil'));?>
	</div>

<?php $this->endWidget(); ?>
