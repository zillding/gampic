<?php
/* @var $this TwitterController or other social controller */
/* @var $model RegisterUsernameForm */
/* @var $form CActiveForm */

$this->pageTitle = app()->name;
regJsFile('form');

?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>true, // display a larger alert block?
	'fade'=>true, // use transitions?
	'closeText'=>'×', // close link text - if set to false, no close link is displayed
	'alerts'=>array( // configurations per alert type
		'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
	),
)); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'register-form',
	'action' => $this->formAction(),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<legend>Just One More Step to Create Your Accout</legend>

	<?php echo $form->errorSummary($model); ?>

	<div class='control-group'>
	<?php echo $form->textFieldRow($model, 'user_name', array('labelOptions'=>array('label'=>false),
																'placeholder'=>'Give yourself a cool name!',
																'class'=>'input-large',
																'hint'=>'Give yourself a cool name!'));?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Create Accout', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'cancel','label'=>'cancel', 'icon'=>'remove'));?>
	</div>

<?php $this->endWidget(); ?>

