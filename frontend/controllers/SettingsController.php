<?php

class SettingsController extends Controller
{
	public function init()
	{
		regJsFile('settings');
		parent::init();
	}

	public function actionIndex()
	{
		$model = new ProfileForm;
		$this->render('index', array('model'=>$model));
	}

	public function actionSave()
	{
		$model=new ProfileForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			app()->end();
		} 

		// collect user input data
		if(isset($_POST['ProfileForm']))
		{
			Helper::pprint($model->attributes);
			$model->attributes = $_POST['ProfileForm'];

			Helper::pprint($_POST['ProfileForm']);
			Helper::ddie($model->attributes);
			
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->save()) {
				// $this->redirect(user()->returnUrl);
			}
		}

		$this->render('index',array('model'=>$model));

		Helper::pprint($model->attributes);
	}

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('deny',
				'users' => array('?'),
			),
		);
	}

}