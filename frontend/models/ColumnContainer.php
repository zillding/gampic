<?php

class ColumnContainer
{
	private $_loadImagesNumber=15;
	/**
	 * load a number of images info from the database
	 * @param integer $number the number of images need loading (default: 15)
	 * @return string the html layout of the loaded images
	 */
	public function load()
	{
		$blocks = '';
		
		for ($i=0; $i < $this->_loadImagesNumber; $i++) { 
			$image_id = rand(1, Image::model()->count());
			$image = Image::model()->find('image_id=:image_id', array(':image_id'=>$image_id));
			$comments = Comment::model()->findAll('image_id=:image_id', array(':image_id'=>$image_id));
			$likes = Like::model()->count('image_id=:image_id', array(':image_id'=>$image_id));
			// check whether the user is login to decide whether to retrieve the like info
			if (!Yii::app()->user->isGuest) {
				$liked=Like::model()->count('user_id=:user_id AND image_id=:image_id', 
					array(':user_id'=>Yii::app()->user->id, ':image_id'=>$image_id));
				$data = array('image_id'=>$image_id, 'title'=>$image['image_title'], 'extension'=>$image['image_extension'], 'likes'=>$likes, 'liked'=>$liked, 'comments'=>$comments);
			} else {
				$data = array('image_id'=>$image_id, 'title'=>$image['image_title'], 'extension'=>$image['image_extension'], 'likes'=>$likes,'comments'=>$comments);
			}
			// create a single image data base on the info retrieved from database
			// create a new block based on the data and append to the array
			$blocks .= BlockController::createBlock($data);
		}
		// echo json_encode($images);
		echo $blocks;
	}
}