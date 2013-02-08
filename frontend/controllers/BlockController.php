<?php

class BlockController extends Controller
{

	/**
	 * create a block based on the passed in array data
	 * @param int the id of the image in the tbl_image table in db
	 * @return string the html content of the whole block
	 */
	public function createBlock($imageId)
	{
		// generate a block
		if ($model=new Block($imageId)) {
			return $this->renderPartial('index',array('model'=>$model),true);
		} else {
			throw new CHttpException(503, 'error creating block with image id='.$imageId1);
		}
	}

	/**
	 * the like feature. like/unlike an image
	 * call "/block/like/?image_id="
	 * @return json      indicate the like status 
	 */
	public function actionLike()
	{
		if (!user()->isGuest) {
			// implement the like function
			$id = r()->getQuery("image_id");
			$id = isset($id) ? $id : "";
			if (TypeValidator::isInt($id)) {
				if ($model=new Block($id)) {
					if($model->like($id)) {
						$arr = array('image_id'=>$id, 'liked'=>$model->liked);
						echo je($arr);
					}
				}
			}
		}
	}

	/**
	 * the comment feature. comment an image
	 * call "/block/comment/?image_id="
	 * @return json indicate the comment status
	 */
	public function actionComment()
	{
		if (!user()->isGuest) {
			// implement the comment function
			$id = r()->getPost("image_id");
			$id = isset($id) ? $id : "";
			if (TypeValidator::isInt($id)) {
				if ($model=new Block($id)) {
					if($model->comment($id)) {
						$arr = array(
							'user_name'=>User::model()->findByPk(Image::model()->findByPk($id)->user_id)->user_name,
							'user_avatar'=>user()->avatar,
							'comment'=>$model->latestComment
							);
						echo je($arr); // 'je' is short for json_encode
					}
				}
			}
		}
	}

	/**
	 * show more comments
	 * call "/block/showComments/?image_id="
	 * @return json all comments associated to the image
	 */
	public function actionShowComments()
	{
		// show more comments
	}

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
			// 'inlineFilterName',
			// array(
			// 	'class'=>'path.to.FilterClass',
			// 	'propertyName'=>'propertyValue',
			// ),
		);
	}

	public function accessRules()
	{
		return array(
			array('deny',
				'actions' => array('like', 'comment'),
				'users' => array('?'),
			),
		);
	}

	/*
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