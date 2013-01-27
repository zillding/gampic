<?php

/**
 * AddForm class.
 * AddForm is the data structure for keeping
 * user Add form data. It is used by the 'Add' action of 'AddController'.
 */
class AddForm extends CFormModel
{
	// store the image file
	public $image_url;
	public $image_title;
	public $image_category;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// for text inputs only
			array('image_url, image_title, image_category', 'required'),
			array('image_url', 'url', 'allowEmpty'=>false, 'pattern'=>'"[.](jpeg|jpg|png|gif)$"'),
			// define the file type
			// array('image_url', 'file', 'types'=>'jpg,jpeg,gif,png', 'allowEmpty'=>true),
			// set the upper bound of the file size
			array('image_url', 'file', 'maxSize'=>1024*1024*2),
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
			'image_url' => 'Image Link',
			'image_title' => 'Image Title',
			'image_category' => 'Category',
		);
	}

	/**
	 * @return boolean whether the Add is successful
	 */
	public function Add()
	{
		// create a new image based on the data collected by the form
		$image=new Image;
		// $image->attributes=$this->attributes;
		$image->attributes=$this->attributes;
		// add the user id attribute to the image
		$image->user_id=Yii::app()->user->id;
		// get the Added file
		$image->file=CAddedFile::getInstance($this, 'image');
		// get the extension of the Added file
		$extension=explode("/", $image->file->getType())[1];
		$image->image_extension=$extension;
		// get the current time
		$image->image_Add_time=date("Y-m-d H:i:s");
		// Helper::print_arr(array_keys(Lookup::items('ImageCategory'))); // for debug only
		if ($image->save()) {
			$image_id=$image->primaryKey;
			$image->file->saveAs(Yii::app()->params['originalImagePath'].'/'.$image_id.'.'.$extension);
			// create thumbnail of the image
			// update the image thumbnail height in the database
			$image->image_thumb_height=$this->createThumbnail($image_id.'.'.$extension);
			$image->save();
			return true;
		} else {
			print 'Add failed';
			// for debug
			print_r($image->getErrors());
			return false;
		}
	}

	/**
	 * a helper function to help create the thumbnail of the Added image
	 * @param string file name of the file
	 * @return int the thumbnail height of the image
	 */
	function createThumbnail($file) {
		require Yii::app()->basePath.'/extensions/SimpleImage.php';
		$image=new SimpleImage();
		$image->load(Yii::app()->params['originalImagePath'].'/'.$file);
		$image->resizeToWidth(192);
		$image->save(Yii::app()->params['thumbnailImagePath'].'/'.$file);
		return $image->getHeight();
	}
}
