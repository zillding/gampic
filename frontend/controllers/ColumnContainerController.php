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
		// pass the gravatar
		// need to pass the $category to javascript
		cs()->registerScript('startColumnContainer', 
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
		$category = r()->getQuery("category"); // the category var here is the int representation
		$category = isset($category) ? $category : "";
		$page = r()->getQuery("page");
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
			Yii::log("unidentified param page: ".$page, "error", "system.web.CController");
			echo "unidentified param page: " . $page; // todo: need to be refined
		}
		
	}

	/**
	 * help add the needed js
	 */
	private function addClientScripts()
	{
		// Helper::print_arr('hello');
		regJsFile('jquery.waypoints.min', bu('plugins/waypoints'));
		regJsFile('columnContainer');
		// Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/columnContainer.js',CClientScript::POS_END);
		if (user()->isGuest) {
			cs()->registerScript('setupBlock',
				'$(function() {
					$(document).on("click", ".block .btn", function() {
						alert("Please log in first!");
					});
				});', CClientScript::POS_END);
		} else {
			regJsFile('block');
		}
		
		// for image display
		regCssFile(array('jquery.fancybox','jquery.fancybox-buttons'), bu('plugins/fancybox'));
		regJsFile(array('jquery.fancybox.pack','jquery.fancybox-buttons'), bu('plugins/fancybox'));
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