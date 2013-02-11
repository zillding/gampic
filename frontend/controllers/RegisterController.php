<?php

class RegisterController extends Controller
{
	/**
	 * Displays the register page
	 */
	public function actionIndex()
	{
		regCssFile('zocial');
		regLessFile('form');
		$model=new RegisterForm('register');
		$this->render('index',array('model'=>$model));
	}

	/**
	 * Displays the register page
	 */
	public function actionRegister()
	{
		$model=new RegisterForm('register');

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		} 

		// collect user input data
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->register())
				$this->redirect(user()->returnUrl);
		}
		// display the register form
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

