<?php

class AllController extends Controller
{
	private $_loadLink = '/all/load';
	private $_category = '';

	public function actionIndex()
	{
		// default action is show
		$this->actionShow();
	}

	// display images
	public function actionShow()
	{
		// get the category
		$category = r()->getQuery('category');
		if (!isset($category)) {
			$this->render('index');
		} else {
			// validate category and route
			if ($this->isValidCategory($category)) {
				$this->render('index');
			} else {
				throw new CHttpException(400, 'bad request. unidentified category: '.$category);
			}
			
		}
	}

	/**
	 * load more images
	 */
	public function actionLoad()
	{
		// the category var here is the code representation
		// which should be an integer
		$category = r()->getPost("category"); 
		$category = isset($category) ? $category : "";
		$page = r()->getPost("page");
		$page = isset($page) ? $page : 0;
		if (TypeValidator::isInt($page)) {
			// need to pass in a page param
			// url: columnContainer/load/?page=2
			// load some images
			$model = new All($category);
			if ($model->hasMore($page)) {
				// there are un-displayed images
				echo $model->load($page);
			} else {
				// no more images to display
				echo $this->renderPartial('//columnContainer/_noMore', array(), true);
			}
		} else {
			throw new CHttpException(400, 'bad request. unidentified param page: '.$page);
		}
	}

	/**
	 * add banner
	 */
	public function addBanner()
	{
		// add necessary js to let the banner scroll
		regLessFile('banner');
		cs()->registerScript('banner', '$(function() {$(".banner").simplyScroll();})', CClientScript::POS_END);
		regCssFile('simplyscroll', bu('plugins/simplyscroll'));
		regJsFile('jquery.simplyscroll.min', bu('plugins/simplyscroll'));
		$this->renderPartial('_banner');
	}

	/**
	 * add this section on the site
	 */
	public function addColumnContainer()
	{
		// create a column container controller to manage this section
		$columnContainer = new ColumnContainerController('columnContainer');
		$columnContainer->initialize($this->_loadLink, array('category'=>$this->_category));
	}

	/**
	 * check whether the passed in category is valid again the database
	 * and set the category attr to be the code (could be '' or '1', '2', '3')
	 * @param  string  $category the game category
	 * @return boolean           whether this category exists in db
	 */
	private function isValidCategory($category)
	{
		if (preg_match('/^all$/i', $category)) {
			return true;
		}
		
		// chekc whether $category is valid
		foreach (Lookup::model()->findAll(array(
			'condition' => 'type=:type',
			'params' => array(':type'=>'ImageCategory'))
			) as $record) {
			if (preg_match('/^'.$record->name.'$/i', $category)) {
				// set the category to the corresponding code instead of name
				$this->_category = $record['code'];
				return true;
			}
		}
		return false;
	}

	/**
	 * the category menu on the header of main layout page
	 * @return array the game category menu
	 */
	public static function gameCategoryMenu()
	{
		$games = array();
		foreach (Lookup::items('ImageCategory') as $value) {
			$games = CMap::mergeArray($games, array(
				array('label' => $value,
					'url' => array('/all/show', 'category'=>strtolower($value))
				)
			));
		};

		return $games;
		
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}