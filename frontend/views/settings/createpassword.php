<?php
/* @var $this SettingsController */
/* @var $model CreatepasswordForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name;
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'createpassword-form',
	'action' => $this->createpasswordFormAction,
	'enableClientValidation'=>true,
	// 'clientOptions' => array('validateOnSubmit'=>true),
	// 'enableAjaxValidation' => true,
	'htmlOptions' => array('class'=>'well'),
)); ?>

	<legend>Gampic - Create Password</legend>

	<?php echo $form->errorSummary($model); ?>

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
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Create', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'cancel','label'=>'Cancel', 'icon'=>'remove','url'=>'/settings'));?>
	</div>

<?php $this->endWidget(); ?>
