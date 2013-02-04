<?php

class ColumnContainerController extends Controller
{

	/**
	 * initialize the column container
	 */
	public function initialize($category)
	{
		// load some images
		$model=new ColumnContainer($category);
		$this->addClientScripts();
		// need to pass the $category to javascript
		Yii::app()->clientScript->registerScript('setCategory', 
			'$(function() {
				ColumnContainer.start("'.$category.'");
			})', CClientScript::POS_END);
		$this->renderPartial('index'); // render the column container, filled later buy actionLoad
	}

	/**
	 * load the column container
	 * print the html of the loaded structure
	 */
	public function actionLoad()
	{
		$category = Yii::app()->getRequest()->getQuery("category"); // the category var here is the int representation
		$category = isset($category) ? $category : "";
		$page = Yii::app()->getRequest()->getQuery("page");
		$page = isset($page) ? $page : 0;
		if (TypeValidator::isInt($page)) {
			// need to pass in a page param
			// url: columnContainer/load/?page=2
			// load some images
			$model = new ColumnContainer($category);
			if ($model->hasMore($page)) {
				// there are un-displayed images
				echo $model->load($page);
			} else {
				// no more images to display
				echo $this->renderPartial('_noMore', array(), true);
			}
		} else {
			echo "unidentified param page: " . $page; // todo: need to be refined
		}
		
	}

	/**
	 * help add the needed js
	 */
	private function addClientScripts()
	{
		// Helper::print_arr('hello');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/plugins/waypoints/jquery.waypoints.min.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/columnContainer.js',CClientScript::POS_END);
		if (Yii::app()->user->isGuest) {
			Yii::app()->clientScript->registerScript('setupBlock',
				'$(function() {
					$(document).on("click", ".block .btn", function() {
						alert("Please log in first!");
					});
				});', CClientScript::POS_END);
		} else {
			Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/block.js',CClientScript::POS_END);
		}
		
		// for image display
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/fancybox/jquery.fancybox.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/plugins/fancybox/jquery.fancybox.pack.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/fancybox/helpers/jquery.fancybox-buttons.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/plugins/fancybox/helpers/jquery.fancybox-buttons.js',CClientScript::POS_END);
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