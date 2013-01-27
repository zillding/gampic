<?php
 class AddController extends Controller
{
	/**
	 * display the add page default use add from url
	 */
	public function actionIndex()
	{
		$uploadModel = new UploadForm;
		$addModel = new AddForm;
		Yii::app()->clientScript->registerScript('displayUploadTab',
			'$(function() {
				$("li#uploadTab").removeClass("active");
				$("li#addTab").addClass("active");
			});',
			CClientScript::POS_END); // have to be placed before render
		$this->render('index',array('uploadModel'=>$uploadModel, 'addModel'=>$addModel));
	}

	/**
	 * Displays the add page
	 */
	public function actionUpload()
	{
		$uploadModel=new UploadForm;
		$addModel = new AddForm;

		// if it is ajax validation request
		// if(isset($_POST['ajax']) && $_POST['ajax']==='upload-form')
		// {
		// 	echo CActiveForm::validate($uploadModel);
		// 	Yii::app()->end();
		// }

		// collect user input data
		if(isset($_POST['UploadForm']))
		{
			$uploadModel->attributes=$_POST['UploadForm'];
			// validate user input and redirect to the previous page if valid
			if($uploadModel->validate() && $uploadModel->upload()) {
				Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You have successfully uploaded to database.');
				$this->redirect('/add/');
			}
		}

		// display the upload form
		Yii::app()->clientScript->registerScript('displayUploadTab',
			'$(function() {
				$("li#uploadTab").addClass("active");
				$("li#addTab").removeClass("active");
			});',
			CClientScript::POS_END);
		$this->render('index',array('uploadModel'=>$uploadModel, 'addModel'=>$addModel));
	}

	/**
	 * Displays the add page
	 */
	public function actionAdd()
	{
		$uploadModel=new UploadForm;
		$addModel = new AddForm;

		// if it is ajax validation request
		// if(isset($_POST['ajax']) && $_POST['ajax']==='upload-form')
		// {
		// 	echo CActiveForm::validate($uploadModel);
		// 	Yii::app()->end();
		// }

		// collect user input data
		if(isset($_POST['AddForm']))
		{
			$addModel->attributes=$_POST['AddForm'];
			// validate user input and redirect to the previous page if valid
			if($addModel->validate() && $addModel->add()) {
				Yii::app()->user->setFlash('success', '<strong>Well done!</strong> You have successfully added to database.');
				$this->redirect('/add/');
			} else {
				Yii::app()->user->setFlash('error', '<strong>Oh snap!</strong> There seems to be some problem. '.$addModel->getErrorMessage());
			}
		}

		// display the add form
		Yii::app()->clientScript->registerScript('displayAddTab',
			'$("li#addTab").ready(function() {
				$("li#uploadTab").removeClass("active");
				$("li#addTab").addClass("active");
			});',
			CClientScript::POS_END);
		$this->render('index',array('uploadModel'=>$uploadModel, 'addModel'=>$addModel));
	}

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
			// array(
			// 	'class'=>'path.to.FilterClass',
			// 	'propertyName'=>'propertyValue',
			// ),
		);
	}

	public function filterAccessControl($filterChain)
	{
		// if user not logged in, don't allow to see this page
		if (Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		$filterChain->run();
	}

	/**
	 * a helper function to help create the thumbnail of the uploaded image
	 * @param string file name of the file
	 * @return int the thumbnail height of the image
	 */
	public static function createThumbnail($file) {
		require Yii::app()->basePath.'/extensions/SimpleImage.php';
		$image=new SimpleImage();
		$image->load(Yii::app()->params['originalImagePath'].'/'.$file);
		$image->resizeToWidth(192);
		$image->save(Yii::app()->params['thumbnailImagePath'].'/'.$file);
		return $image->getHeight();
	}

	// Uncomment the following methods and override them if needed
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