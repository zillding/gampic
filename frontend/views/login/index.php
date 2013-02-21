<?php
/* @var $this LoginController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=app()->name . ' - Login';
// $this->breadcrumbs=array(
// 	'Login',
// );
?>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6">

		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'login-form',
			'action' => $this->createUrl('login'),
			'enableClientValidation'=>true,
			'htmlOptions'=>array('class'=>'well'),
		)); ?>

			<legend>Gampic - Login</legend>

			<?php echo $form->errorSummary($model); ?>
			
			<div class='control-group'>
			<?php echo $form->textFieldRow($model, 'user_name', array('labelOptions'=>array('label'=>false),
																		'placeholder'=>'Username',
																		'class'=>'input-large'));?>
			</div>

			<div class='control-group'>
			<?php echo $form->passwordFieldRow($model, 'user_password', array('labelOptions'=>array('label'=>false),
																		'placeholder'=>'Password',
																		'class'=>'input-large'));?>
			</div>

			<div class='control-group'>
			<?php echo $form->checkBoxRow($model, 'rememberMe');?>
			</div>

			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Login', 'icon'=>'ok'));?>
			</div>

		<?php $this->endWidget(); ?>
				
		</div>

		<div class="span6">
			<p class="lead text-info"><span class="label label-info">Info</span> or you can</p>

			<div class="zocial-row">
				<a href="/twitter" class="zocial twitter">Login with Twitter</a>
			</div>
			<div class="zocial-row">
				<a href="/facebook" class="zocial facebook">Login with Facebook</a>
			</div>
			
		</div>
	</div>
</div>
