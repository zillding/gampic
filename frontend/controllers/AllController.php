<?php

class AllController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * add banner
	 */
	public function addBanner()
	{
		// add necessary js to let the banner scroll
		Yii::app()->clientScript->registerScript('banner', '$(function() {$(".banner").simplyScroll();})', CClientScript::POS_BEGIN);
		Yii::app()->clientScript->registerScriptFile('js/jquery.simplyscroll.min.js', CClientScript::POS_END);
		$this->renderPartial('_banner');
	}

	/**
	 * add this section on the site
	 */
	public function addColumnContainer()
	{
		// create a column container controller to manage this section
		$columnContainer = new ColumnContainerController('columnContainer');
		$columnContainer->initialize();
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