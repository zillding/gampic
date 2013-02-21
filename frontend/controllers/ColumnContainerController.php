<?php

class ColumnContainerController extends Controller
{
	const LOAD_IMAGE_NUMBER = 15;

	/**
	 * initialize the column container
	 * @param  string $loadLink the load link which the js will call
	 * @param  array $params the params the js will call with the link
	 */
	public function initialize($loadLink, $params)
	{
		// load some images
		$this->addClientScripts();
		// need to pass the $category to javascript
		cs()->registerScript('startColumnContainer', 
			'$(function() {
				ColumnContainer.start("'.$loadLink.'", '.je($params).');
			})', CClientScript::POS_END);

		$this->renderPartial('index'); // render the column container, filled later buy actionLoad
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
		// facebook like button
		regJsFile('facebook', bu('plugins/facebook'), CClientScript::POS_BEGIN);
		// google+ plus one button
		regJsFile('googleplus', bu('plugins/googleplus'));
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