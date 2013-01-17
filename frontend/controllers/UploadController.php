<?php

class UploadController extends Controller
{
	/**
	 * display the upload form
	 */
	public function actionIndex()
	{
		// if user not logged in, don't allow to see this page
		if (Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}

		$model=new UploadForm;
		$this->render('index',array('model'=>$model));
	}

	/**
	 * Displays the upload page
	 */
	public function actionUpload()
	{
		$model=new UploadForm;

		// if it is ajax validation request
		// if(isset($_POST['ajax']) && $_POST['ajax']==='upload-form')
		// {
		// 	echo CActiveForm::validate($model);
		// 	Yii::app()->end();
		// }

		// collect user input data
		if(isset($_POST['UploadForm']))
		{
			$model->attributes=$_POST['UploadForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->upload());
				// print 'successfully uploaded to database';
		}
		// display the upload form
		$this->render('index',array('model'=>$model));
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