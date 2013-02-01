<?php
/**
 * column container model
 */

class ColumnContainer
{
	private $_loadImagesNumber=15;

	/**
	 * initiate the conlumn contailer
	 * add necessary client scripts
	 */
	public function __construct()
	{
	}

	/**
	 * check whether there are more images in the database to display
	 * @param  integer $page the page number
	 * @return boolean       whether there are more
	 */
	public function hasMore($page=0)
	{
		return (Image::model()->count() - $page * $this->_loadImagesNumber) > 0;
	}

	/**
	 * load a number of images info from the database
	 * @param int page the page number which should be loaded
	 * @return string the html layout of the loaded images
	 */
	public function load($page=0)
	{
		$blocks = '';

		$start = Image::model()->count() - $page * $this->_loadImagesNumber;
		$end = ($start - $this->_loadImagesNumber) > 0 ? $start - $this->_loadImagesNumber : 0;
		for ($i=$start; $i > $end; $i--) { 
			// create a single image data base on the info retrieved from database
			// create a new block based on the data and append to the array
			$block = new BlockController('block');
			$blocks .= $block->createBlock($i);
			
		}
		return $blocks;
		
	}

}