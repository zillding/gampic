<?php

class AllController extends Controller
{
	private $_category='';

	public function actionIndex()
	{
		// get the category
		$category = Yii::app()->getRequest()->getQuery('category');
		if (!isset($category)) {
			$this->render('index');
		} else {
			// validate category and route
			if ($this->isValidCategory($category)) {
				// Helper::print_arr($this->_category);
				// todo: render corresponding page
				$this->render('index');
			} else {
				// re-direct to the home page
				$this->redirect('/');
			}
			
		}
	}

	/**
	 * add banner
	 */
	public function addBanner()
	{
		// add necessary js to let the banner scroll
		Yii::app()->clientScript->registerScript('banner', '$(function() {$(".banner").simplyScroll();})', CClientScript::POS_BEGIN);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.simplyscroll.min.js', CClientScript::POS_END);
		$this->renderPartial('_banner');
	}

	/**
	 * add this section on the site
	 */
	public function addColumnContainer()
	{
		// create a column container controller to manage this section
		$columnContainer = new ColumnContainerController('columnContainer');
		// the category passed is in the int form
		$columnContainer->initialize($this->_category);
	}

	/**
	 * check whether the passed in category is valid again the database
	 * @param  string  $category the game category
	 * @return boolean           whether this category exists in db
	 */
	private function isValidCategory($category)
	{
		// chekc whether $category is valid
		foreach (Lookup::model()->findAll(array(
			'condition' => 'type=:type',
			'params' => array(':type'=>'ImageCategory'))
			) as $record) {
			if (preg_match('/^'.$record['name'].'$/i', $category)) {
				// set the category to the corresponding code instead of name
				$this->_category = $record['code'];
				return true;
			}
		}
		return false;
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