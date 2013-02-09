<?php
/* @var $this RegisterController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Register';
// $this->breadcrumbs=array(
// 	'Register',
// );
?>

<h1>Register</h1>

<p>Please fill out the following form with your credentials:</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'register-form',
	'action' => $this->createUrl('register'),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class='control-group'>
	<?php echo $form->textFieldRow($model, 'user_name', array('class'=>'span3'));?>
	</div>

	<div class='control-group'>
	<?php echo $form->textFieldRow($model, 'user_email', array('class'=>'span3'));?>
	</div>

	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'user_password', array('class'=>'span3'));?>
	</div>
	
	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'confirm_user_password', array('class'=>'span3'));?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Register', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'Reset', 'icon'=>'pencil'));?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->