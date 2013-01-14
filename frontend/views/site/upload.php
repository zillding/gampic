<?php
/* @var $this UploadFormController */
/* @var $model UploadForm */
/* @var $form CActiveForm */
$this->pageTitle=Yii::app()->name . ' - Upload';
$this->breadcrumbs=array(
	'Upload',
);
?>

<h1>Upload</h1>

<p>Image format: "jpg", "jpeg", "png" or "gif"</p>
<p>Image size must be less than 2MB</p>

<div class="form">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'upload-form',
		'enableClientValidation'=>true,
		'htmlOptions'=>array('class' => 'well', 'enctype'=>'multipart/form-data'),
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class='control-group'>
	<?php echo $form->fileFieldRow($model,'image', array()); // todo: css need adjusting ?>
	</div>
	<div class='control-group'>
	<?php echo $form->textFieldRow($model,'image_title'); ?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Upload', 'icon'=>'ok'));?>
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->