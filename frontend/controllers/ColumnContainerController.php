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
			throw new CHttpException(400, 'bad request. unidentified param page: '.$page);
		}
		
	}

	/**
	 * help add the needed js
	 */
	private function addClientScripts()
	{
		regLessFile('columnContainer');
		// Helper::print_arr('hello');
		regJsFile('jquery.waypoints.min', bu('plugins/waypoints'));
		regJsFile('columnContainer');
		regJsFile('block');
		if (user()->isGuest) {
			cs()->registerScript('setupBlock',
				'$(function() {
					Block.setupGuest();
				});', CClientScript::POS_END);
		} else {
			cs()->registerScript('setupBlock',
				'$(function() {
					Block.setupAll();
				});', CClientScript::POS_END);
		}
		
		// for image display
		regCssFile(array('jquery.fancybox','jquery.fancybox-buttons'), bu('plugins/fancybox'));
		regJsFile(array('jquery.fancybox.pack','jquery.fancybox-buttons'), bu('plugins/fancybox'));
		// twitter button
		regJsFile('twitter', bu('plugins/twitter'));
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