<?php

class BlockController extends Controller
{
	public function actionIndex()
	{
		// for debug only
		// generate a block
		$imageId=1;
		$model = new Block();
		if ($model->create($imageId)) {
			// return $this->renderPartial('index',array('model'=>$model),true);
			$this->render('index',array('model'=>$model));
		} else {
			die('error');
		}
	}

	/**
	 * create a block based on the passed in array data
	 * @param int the id of the image in the tbl_image table in db
	 * @return string the html content of the whole block
	 */
	public function createBlock($imageId)
	{
		// generate a block
		$model = new Block();
		if ($model->create($imageId)) {
			echo $this->renderPartial('index',array('model'=>$model),true);
			// $this->renderPartial('index',array('model'=>$model));
		} else {
			die('error creating block with image id='.$imageId);
		}
	}

	public function like($data)
	{
		// implement the like function
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