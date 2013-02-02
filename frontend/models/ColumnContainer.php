<?php
/**
 * column container model
 */

class ColumnContainer
{
	private $_loadImagesNumber = 15;
	private $_category;

	/**
	 * initiate the conlumn contailer
	 * add necessary client scripts
	 */
	public function __construct($category)
	{
		$this->_category = $category;
	}

	/**
	 * check whether there are more images in the database to display
	 * @param  integer $page the page number
	 * @return boolean       whether there are more
	 */
	public function hasMore($page=0)
	{
		// have to take the condition into consideration
		$condition = empty($this->_category) ? "" : 'image_category='.$this->_category;
		return (Image::model()->count($condition) - $page * $this->_loadImagesNumber) > 0;
	}

	/**
	 * load a number of images info from the database
	 * @param int page the page number which should be loaded
	 * @return string the html layout of the loaded images
	 */
	public function load($page=0)
	{
		$blocks = '';
		$model = Image::model();

		$condition = empty($this->_category) ? "" : 'image_category='.$this->_category;
		$totalItems = $model->count($condition);

		$criteria = new CDbCriteria(array(
			'condition' => $condition,
			'order' => 'image_upload_time DESC',
			'limit' => $this->_loadImagesNumber,
			'offset' => $page * $this->_loadImagesNumber
		));
		$result = $model->findAll($criteria);
		foreach ($result as $record) {
			$block = new BlockController('block');
			$blocks .= $block->createBlock($record['image_id']);
		}

		return $blocks;
		
	}

}