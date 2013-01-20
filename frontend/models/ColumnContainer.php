<?php

class ColumnContainer 
{
	/**
	 * load a number of images info from the database
	 * @param integer $number the number of images need loading (default: 15)
	 * @return json message a json encode message describing the images
	 */
	public function load($number=15)
	{
		for ($i=0; $i < $number; $i++) { 
			$id = rand(1, Image::model()->count());
			$image = Image::model()->find('image_id=:image_id', array(':image_id'=>$id));
			$comments = Comment::model()->findAll('image_id=:image_id', array(':image_id'=>$id));
			$likes = Like::model()->count('image_id=:image_id', array(':image_id'=>$id));

			$data = array('image_id'=>$id, 'title'=>$image['image_title'], 'extension'=>$image['image_extension'], 'likes'=>$likes,'comments'=>$comments);
			$images[] = $data;
		}
		// echo json_encode($images);
		Helper::print_arr($images);
	}
}