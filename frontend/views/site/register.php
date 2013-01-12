<?php
/* @var $this SiteController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);
?>

<h1>Register</h1>

<p>Please fill out the following form with your credentials:</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name'); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email'); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_password'); ?>
		<?php echo $form->passwordField($model,'user_password'); ?>
		<?php echo $form->error($model,'user_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'confirm_user_password'); ?>
		<?php echo $form->passwordField($model,'confirm_user_password'); ?>
		<?php echo $form->error($model,'confirm_user_password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->