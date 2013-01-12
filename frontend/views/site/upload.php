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

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'upload-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_title'); ?>
		<?php echo $form->textField($model,'image_title'); ?>
		<?php echo $form->error($model,'image_title'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->