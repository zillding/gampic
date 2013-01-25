<?php

class ColumnContainerController extends Controller
{
	/**
	 * initialize the column container
	 */
	public function initialize()
	{
		// load some images
		$model=new ColumnContainer;
		$this->addJs();
		$this->renderPartial('index');
	}

	/**
	 * load the column container
	 * print the html of the loaded structure
	 */
	public function actionLoad()
	{
		// load some images
		// Helper::print_arr($this->_model);
		$model = new ColumnContainer;
		echo $model->load();
		// Helper::print_arr($this->_model);
	}

	/**
	 * help add the needed js
	 */
	private function addJs()
	{
		// Helper::print_arr('hello');
		Yii::app()->clientScript->registerScriptFile('js/setupBlocks.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScript('loadData',
			'$(function() {
				$.get("columnContainer/load", function(data) {
					$(".columnContainer").append(data);
				});
				// need to make sure the setup blocks run after the DOM are rendered
				wait(2);
			});',
			CClientScript::POS_HEAD);
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