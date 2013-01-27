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
			// define the file type
			array('image_url', 'url', 'allowEmpty'=>false, 'pattern'=>'"[.](jpeg|jpg|png|gif)$"'),
			// set the upper bound of the file size
			array('image_url', 'sizeLimit', 'maxSize'=>1024*1024*2),
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
	 * check if the remote file size is within the size limit
	 */
	public function sizeLimit($attribute, $params)
	{
		// check the size of the remote file
		$fileSize = $this->getRemoteFileSize($this->attributes[$attribute]);
		if ($fileSize > $params['maxSize']) {
			$this->addError($attribute, 'the file size is too big!');
		}
	}

	/**
	 * @return boolean whether the Add is successful
	 */
	public function add()
	{
		// create a new image based on the data collected by the form
		$image=new Image;
		// $image->attributes=$this->attributes;
		$image->attributes=$this->attributes;
		// add the user id attribute to the image
		$image->user_id=Yii::app()->user->id;
		// get the Added file
		$image->file=@file_get_contents($this->attributes['image_url']);
		if (is_resource(@imagecreatefromstring($image->file))) {
			// image is valid
			// get the extension of the Added file
			$extension=explode("/", getimagesize($this->image_url)['mime'])[1];
			$image->image_extension=$extension;
			// get the current time
			$image->image_upload_time=date("Y-m-d H:i:s");
			if ($image->save()) {
				$image_id=$image->primaryKey;
				// save the original file
				if (file_put_contents(Yii::app()->params['originalImagePath'].'/'.$image_id.'.'.$extension, $image->file)) {
					// create thumbnail of the image
					$image->image_thumb_height= AddController::createThumbnail($image_id.'.'.$extension);
					// update the image thumbnail height in the database
					$image->save();
					return true;
				} else {
					// failed saving the file
					return false;
				}
				return true;
			} else {
				print 'Add failed';
				// for debug
				print_r($image->getErrors());
				return false;
			}
		} else {
			echo 'invalid file!';
			return false;
		}
	}

	/**
	 * determine the remote file size
	 * @param string $remoteFile the url of the remote file
	 * @return int the file size in bits
	 */
	private function getRemoteFileSize($url)
	{
		$uh = curl_init();  
		curl_setopt($uh, CURLOPT_URL, $url);  
		// set NO-BODY to not receive body part  
		curl_setopt($uh, CURLOPT_NOBODY, 1);  
		// set HEADER to be false, we don't need header  
		curl_setopt($uh, CURLOPT_HEADER, 0);  
		// retrieve last modification time  
		curl_setopt($uh, CURLOPT_FILETIME, 1);  
		curl_exec($uh);  
		// assign filesize into $filesize variable  
		$filesize = curl_getinfo($uh,CURLINFO_CONTENT_LENGTH_DOWNLOAD);  
		curl_close($uh);	

		return $filesize;
	}

}
