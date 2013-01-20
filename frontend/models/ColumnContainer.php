<?php

class ColumnContainer
{
	/**
	 * load a number of images info from the database
	 * @param integer $number the number of images need loading (default: 15)
	 * @return string the html layout of the loaded images
	 */
	public function load($number=15)
	{
		for ($i=0; $i < $number; $i++) { 
			$id = rand(1, Image::model()->count());
			$image = Image::model()->find('image_id=:image_id', array(':image_id'=>$id));
			$comments = Comment::model()->findAll('image_id=:image_id', array(':image_id'=>$id));
			$likes = Like::model()->count('image_id=:image_id', array(':image_id'=>$id));
			// create a single image data base on the info retrieved from database
			$data = array('image_id'=>$id, 'title'=>$image['image_title'], 'extension'=>$image['image_extension'], 'likes'=>$likes,'comments'=>$comments);
			// create a new block based on the data and append to the array
			$blocks[] = BlockController::createBlock($data);
		}
		// echo json_encode($images);
		// Helper::print_arr($blocks);
	}
}