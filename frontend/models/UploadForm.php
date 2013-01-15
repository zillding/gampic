<?php

/**
 * UploadForm class.
 * UploadForm is the data structure for keeping
 * user upload form data. It is used by the 'upload' action of 'SiteController'.
 */
class UploadForm extends CFormModel
{
	// store the image file
	public $image;
	public $image_title;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// for text inputs only
			array('image_title', 'required'),
			// define the file type
			array('image', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true),
			// set the upper bound of the file size
			array('image', 'file', 'maxSize'=>1024*1024*2),
			array('image_title', 'length', 'max'=>50, 'min'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image_title', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * todo: upload the image
	 * @return boolean whether the upload is successful
	 */
	public function upload()
	{
		// create a new image based on the data collected by the form
		$image=new Image;
		// $image->attributes=$this->attributes;
		$image->attributes=$this->attributes;
		// add the user id attribute to the image
		$image->user_id=Yii::app()->user->id;
		// get the uploaded file
		$image->file=CUploadedFile::getInstance($this, 'image');
		// get the extension of the uploaded file
		$extension=explode("/", $image->file->getType())[1];
		$image->image_extension=$extension;
		// get the current time
		$image->image_upload_time=date("Y-m-d H:i:s");
		// die();
		if ($image->save()) {
			$image_id=$image->primaryKey;
			$image->file->saveAs(Yii::app()->basePath.'/../common/data/orig/'.$image_id.'.'.$extension);
			// create thumbnail of the image
			// update the image thumbnail height in the database
			$image->image_thumb_height=$this->createThumbnail($image_id.'.'.$extension);
			$image->save();
			return true;
		} else {
			print 'upload failed';
			// for debug
			print_r($image->getErrors());
			return false;
		}
	}

	/**
	 * a helper function to help create the thumbnail of the uploaded image
	 * @param string file name of the file
	 * @return int the thumbnail height of the image
	 */
	function createThumbnail($file) {
		require Yii::app()->basePath.'/extensions/SimpleImage.php';
		$image=new SimpleImage();
		$image->load(Yii::app()->basePath.'/../common/data/orig/'.$file);
		$image->resizeToWidth(192);
		$image->save(Yii::app()->basePath.'/../common/data/thumb/'.$file);
		return $image->getHeight();
	}
}
