<?php

/**
 * UploadForm class.
 * UploadForm is the data structure for keeping
 * user upload form data. It is used by the 'upload' action of 'AddController'.
 */
class UploadForm extends CFormModel
{
	// store the image file
	public $image;
	public $image_title;
	public $image_category;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// for text inputs only
			array('image_title, image_category', 'required'),
			// define the file type
			array('image', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true),
			// set the upper bound of the file size
			array('image', 'file', 'maxSize'=>1024*1024*2),
			array('image_title', 'length', 'max'=>50, 'min'=>2),
			array('image_category', 'in', 'range'=>array_keys(Lookup::items('ImageCategory')), 'allowEmpty'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image_title, image_category', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'image' => 'Upload An Image',
			'image_title' => 'Image Title',
			'image_category' => 'Category',
		);
	}

	/**
	 * @return boolean whether the upload is successful
	 */
	public function upload()
	{
		// create a new image based on the data collected by the form
		$image=new Image;
		// $image->attributes=$this->attributes;
		$image->attributes=$this->attributes;
		// add the user id attribute to the image
		$image->user_id=user()->id;
		// get the uploaded file
		$image->file=CUploadedFile::getInstance($this, 'image');
		// get the extension of the uploaded file
		$extension=explode("/", $image->file->getType())[1];
		$image->image_extension=$extension;
		// get the current time
		$image->image_upload_time=date("Y-m-d H:i:s");
		// Helper::print_arr(array_keys(Lookup::items('ImageCategory'))); // for debug only
		if ($image->save()) {
			$image_id=$image->primaryKey;
			$image->file->saveAs(param('originalImagePath').'/'.$image_id.'.'.$extension);
			// create thumbnail of the image
			// update the image thumbnail height in the database
			$image->image_thumb_height= AddController::createThumbnail($image_id.'.'.$extension);
			$image->save();
			return true;
		} else {
			print_r($image->getErrors());
			return false;
		}
	}

}
