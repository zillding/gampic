<?php

class ColumnContainerController extends Controller
{

	/**
	 * initialize the column container
	 */
	public function initialize($category)
	{
		// load some images
		$model=new ColumnContainer;
		$model->setCategory($category);
		$this->addJs();
		$this->renderPartial('index');
	}

	/**
	 * load the column container
	 * print the html of the loaded structure
	 */
	public function actionLoad()
	{
		$page = Yii::app()->getRequest()->getQuery("page");
		$page = isset($page) ? $page : 0;
		if (TypeValidator::isInt($page)) {
			// need to pass in a page param
			// url: columnContainer/load/?page=2
			// load some images
			$model = new ColumnContainer;
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
	private function addJs()
	{
		// Helper::print_arr('hello');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.waypoints.min.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/columnContainer.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/block.js',CClientScript::POS_END);
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