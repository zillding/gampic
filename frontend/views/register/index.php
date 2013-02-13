<?php
/* @var $this RegisterController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Register';
// $this->breadcrumbs=array(
// 	'Register',
// );
?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6">

		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'register-form',
			'action' => $this->createUrl('register'),
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>true,
			'htmlOptions'=>array('class'=>'well'),
		)); ?>

			<legend>Gampic - Register</legend>

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
				<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Register', 'icon'=>'ok'));?>
				<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'Reset', 'icon'=>'pencil'));?>
			</div>

		<?php $this->endWidget(); ?>
				
		</div>
		<div class="span6">
			<p class="lead text-info"><span class="label label-info">Info</span> or you can</p>
			
			<a href="/twitter" class="zocial twitter">Register with Twitter</a>
			<br>
			<a href="" class="zocial facebook">Register with Facebook</a>

		</div>
	</div>
</div>
