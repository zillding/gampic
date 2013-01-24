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
			$dataImageId = rand(1, Image::model()->count());
			// create a single image data base on the info retrieved from database
			// create a new block based on the data and append to the array
			$blocks .= BlockController::createBlock($dataImageId);
			
		}

		return $blocks;
	}
}