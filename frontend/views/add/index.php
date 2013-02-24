<?php
/* @var $this AddController */
/* @var $uploadModel UploadForm */
/* @var $addModel AddForm */
/* @var $form CActiveForm */
$this->pageTitle=Yii::app()->name . ' - Add';

$fileHint = '<span class="label label-important">Important</span> File format must be "png", "jpg", "jpeg" or "gif" and size must be less than 2MB.'
?>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<div class="tabbale tabs-left">
	<ul class="nav nav-tabs">
		<li id="addTab"><a href="#tab1" data-toggle="tab">URL</a></li>
		<li id="uploadTab"><a href="#tab2" data-toggle="tab">Local File</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab1">

			<div class="form">

			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id' => 'add-form',
				'type' => 'horizontal',
				'action' => $this->createUrl('add'),
				'enableClientValidation'=>true,
				'htmlOptions'=>array('class' => 'well', 'enctype'=>'multipart/form-data'),
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>

			<fieldset>
				<legend>Add a Gampic</legend>
				<p class="note">Fields with <span class="required">*</span> are required.</p><br>

				<?php echo $form->errorSummary($addModel); ?>

				<?php echo $form->textFieldRow($addModel,'image_url', array('class'=>'span5', 'placeholder'=>'http://', 'hint'=>$fileHint)); ?>
				<?php echo $form->textFieldRow($addModel,'image_title', array('class'=>'span5')); ?>
				<?php echo $form->dropDownListRow($addModel,'image_category',
					CMap::mergeArray(array('choose a category...'),
					Lookup::items('ImageCategory'))); ?>
			</fieldset>

			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Add', 'icon'=>'ok', 'size'=>'large'));?>
			</div>
			<?php $this->endWidget(); ?>

			</div><!-- form -->		

		</div>
		<div class="tab-pane" id="tab2">

			<div class="form">

			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id' => 'upload-form',
				'type' => 'horizontal',
				'action' => $this->createUrl('upload'),
				'enableClientValidation'=>true,
				'htmlOptions'=>array('class' => 'well', 'enctype'=>'multipart/form-data'),
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>

			<fieldset>
				<legend>Upload a Gampic</legend>
				<p class="note">Fields with <span class="required">*</span> are required.</p><br>

				<?php echo $form->errorSummary($uploadModel); ?>

				<?php echo $form->fileFieldRow($uploadModel,'image', array('class'=>'span5', 'hint'=>$fileHint)); // todo: css need adjusting ?>
				<?php echo $form->textFieldRow($uploadModel,'image_title', array('class'=>'span5')); ?>
				<?php echo $form->dropDownListRow($uploadModel,'image_category',
					CMap::mergeArray(array('choose a category...'),
					Lookup::items('ImageCategory'))); ?>
			</fieldset>

			<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Upload', 'icon'=>'ok'));?>
			</div>
			<?php $this->endWidget(); ?>

			</div><!-- form -->		

		</div>
	</div><!-- end of tab-content --> 
</div><!-- end of tab -->


