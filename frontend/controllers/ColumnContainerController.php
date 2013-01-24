<?php

class ColumnContainerController extends Controller
{
	// public function actionIndex()
	// {
	// 	$this->render('index');
	// }

	/**
	 * load the column container
	 * print the html of the loaded structure
	 */
	public function actionLoad()
	{
		// load some images
		$model=new ColumnContainer;
		$this->addJs();
		echo $model->load();
	}

	/**
	 * help add the needed js
	 */
	private function addJs()
	{
		// Helper::print_arr('hello');
		$cs = new CClientScript;
		$cs->registerScript('loadData',
			'$(function() {
				$.get("columnContainer/load", function(data) {
					$(".columnContainer").append(data);
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