<?php
/**
 * dashboard model
 */

class Dashboard
{
	private $_user;

	public function __construct($user)
	{
		$this->_user = $user;
	}

	/**
	 * check whether there are more images in the database to display
	 * @param  integer $page the page number
	 * @return boolean whether there are more
	 */
	public function hasMoreAdded($page=0)
	{
		// have to take the condition into consideration
		$condition = 'user_id='.$this->_user->user_id;
		return (Image::model()->count($condition) - $page * ColumnContainerController::LOAD_IMAGE_NUMBER) > 0;
	}

	/**
	 * load a number of images info from the database
	 * @param int page the page number which should be loaded
	 * @return string the html layout of the loaded images
	 */
	public function loadAdded($page=0)
	{
		$blocks = '';
		$model = Image::model();

		$condition = 'user_id='.$this->_user->user_id;
		$totalItems = $model->count($condition);

		$criteria = new CDbCriteria(array(
			'condition' => $condition,
			'order' => 'image_upload_time DESC',
			'limit' => ColumnContainerController::LOAD_IMAGE_NUMBER,
			'offset' => $page * ColumnContainerController::LOAD_IMAGE_NUMBER
		));
		$result = $model->findAll($criteria);
		foreach ($result as $record) {
			$block = new BlockController('block');
			$blocks .= $block->createBlock($record['image_id']);
		}

		return $blocks;
		
	}

	/**
	 * check whether there are more images in the database to display
	 * @param  integer $page the page number
	 * @return boolean whether there are more
	 */
	public function hasMoreLikes($page=0)
	{
		// have to take the condition into consideration
		$condition = 'user_id='.$this->_user->user_id;
		return (Like::model()->count($condition) - $page * ColumnContainerController::LOAD_IMAGE_NUMBER) > 0;
	}

	/**
	 * load a number of images info from the database
	 * @param int page the page number which should be loaded
	 * @return string the html layout of the loaded images
	 */
	public function loadLikes($page=0)
	{
		$blocks = '';
		$model = Image::model();

		$condition = 'user_id='.$this->_user->user_id;
		$totalItems = $model->count($condition);

		$criteria = new CDbCriteria(array(
			'condition' => $condition,
			'order' => 'image_upload_time DESC',
			'limit' => ColumnContainerController::LOAD_IMAGE_NUMBER,
			'offset' => $page * ColumnContainerController::LOAD_IMAGE_NUMBER
		));
		$result = $model->findAll($criteria);
		foreach ($result as $record) {
			$block = new BlockController('block');
			$blocks .= $block->createBlock($record['image_id']);
		}

		return $blocks;
		
	}

}