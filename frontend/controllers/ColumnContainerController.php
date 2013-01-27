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
			'$("#columnContainer").infinitescroll({
				navSelector: "#next:last",
				nextSelector: "a#next:last",
				itemSelector: ".block",
				debug: true,
				dataType: "html",
				path: function(index) {
					return "/columnContainer/load";
				}
			}, function(newElements, data, url) {
				wait(1);
			});

			$(function() {
				// $("#columnContainer").load("columnContainer/load", function() {
				// 	wait(0);
				// });


				// create an event to detect whether the window has done resizing
				$(window).resize(function() {
					if(this.resizeTO) clearTimeout(this.resizeTO);
					this.resizeTO = setTimeout(function() {
						$(this).trigger("resizeEnd");
					}, 500);
				});

				$(window).bind("resizeEnd", function() {
					setupBlocks();
				});

			});',
			CClientScript::POS_END);
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