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
			return $this->renderPartial('index',array('model'=>$model),true);
			// $this->renderPartial('index',array('model'=>$model));
		} else {
			die('error creating block with image id='.$imageId);
		}
	}

	/**
	 * the like feature. like/unlike an image
	 * @return json      indicate the like status 
	 */
	public function actionLike()
	{
		if (!Yii::app()->user->isGuest) {
			// implement the like function
			$id = Yii::app()->getRequest()->getQuery("image_id");
			$id = isset($id) ? $id : "";
			if (TypeValidator::isInt($id)) {
				$model = new Block;
				if($model->like($id)) {
					$arr = array('image_id'=>$id, 'liked'=>$model->liked);
					echo json_encode($arr);
				}
			}
		}
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