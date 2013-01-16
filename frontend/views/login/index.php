<?php
/* @var $this LoginController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
// $this->breadcrumbs=array(
// 	'Login',
// );
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'login-form',
		'action' => $this->createUrl('login'),
		'enableClientValidation'=>true,
		'htmlOptions'=>array('class'=>'well'),
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class='control-group'>
	<?php echo $form->textFieldRow($model, 'user_name', array('class'=>'span3'));?>
	</div>
	<div class='control-group'>
	<?php echo $form->passwordFieldRow($model, 'user_password', array('class'=>'span3'));?>
	</div>
	<?php echo $form->checkBoxRow($model, 'rememberMe');?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Login', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'Reset'));?>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
