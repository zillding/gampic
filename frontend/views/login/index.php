<?php
/* @var $this LoginController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=app()->name . ' - Login';
// $this->breadcrumbs=array(
// 	'Login',
// );
?>


<div class="container-fluid well">
	<div class="row-fluid">
		<div class="span6">
			<h1>Gampic</h1>
			<div class="form">
				<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					'id'=>'login-form',
					'action' => $this->createUrl('login'),
					'enableClientValidation'=>true,
					// 'htmlOptions'=>array('class'=>'well'),
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<?php echo $form->errorSummary($model); ?>
				
				<?php echo $form->textFieldRow($model, 'user_name');?>
				<?php echo $form->passwordFieldRow($model, 'user_password');?>
				<?php echo $form->checkBoxRow($model, 'rememberMe');?>

				<div class="form-actions">
					<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Login', 'icon'=>'ok'));?>
				</div>
				<?php $this->endWidget(); ?>
			</div><!-- form -->
				
		</div>

		<div class="span6">

			<h3>Or You can login with</h3>

			<div class="well well-small">
				<a href="" class="zocial twitter">Login with Twitter</a>
			</div>
			<br>
			<div class="well well-small">
				<a href="" class="zocial facebook">Login with Facebook</a>
			</div>
			
		</div>
	</div>
</div>
