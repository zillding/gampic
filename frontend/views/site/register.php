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

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'register-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model, 'user_name', array('class'=>'span3'));?>
	<?php echo $form->textFieldRow($model, 'user_email', array('class'=>'span3'));?>
	<?php echo $form->passwordFieldRow($model, 'user_password', array('class'=>'span3'));?>
	<?php echo $form->passwordFieldRow($model, 'confirm_user_password', array('class'=>'span3'));?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Register', 'icon'=>'ok'));?>
		<!-- todo: add functionality -->
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'cancel','type'=>'secondary','label'=>'Cancel', 'icon'=>'remove'));?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->