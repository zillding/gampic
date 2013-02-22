<?php

class FacebookController extends Controller
{
	public function actionIndex()
	{
		$model = new FB;

		if ($model->isGuest) {
			// the user hasn't logged in facebook yet
			$model->FBlogin();
		} else {
			// Helper::ddie($_SESSION);
			$facebookId = $model->getFacebookId();
			$facebookName = $model->getFacebookName();
			// the user has alr logged in facebook and authorized the app
			// need to check whether the user has alr registered in the local
			// db by verifying the fb id
			if ($model->verifyUser($facebookId)) {
				// user has registered before
				// login the user
				if ($model->login($facebookId)) {
					$this->redirect('/');
				} else {
					// error
					Yii::log('cannot login local user now', 'error', 'system.web.CController');
				}
			} else {
				// first time sign in with fb
				// first time sign in with facebook
				user()->setFlash('success', '<strong>Well done!</strong> You successfully connected to <strong>Facebook</strong> as <strong>'.$facebookName.'</strong>');
				// ask the user to select a user name
				if (user()->isGuest) {
					$this->render('//register/social', array('model'=>new SocialRegisterForm));
				} else {
					$formModel = new SocialRegisterForm;
					$formModel->user_name = user()->name;
					if ($formModel->connectFacebook()) {
						$this->redirect('/settings');
					}
				}
			}
			
		}
	}

	/**
	 * register the facebook user
	 */
	public function actionRegister()
	{
		$model=new SocialRegisterForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			app()->end();
		} 

		// collect user input data
		if(isset($_POST['SocialRegisterForm']))
		{
			$model->attributes=$_POST['SocialRegisterForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->registerFacebook())
				$this->redirect(user()->returnUrl);
		}
		// display the register form
		$this->render('//register/social',array('model'=>$model));
	}

	/**
	 * set the register form action
	 * @return string the url to which the form submit
	 */
	public function formAction()
	{
		return url('facebook/register');
	}

	/*
	// Uncomment the following methods and override them if needed
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
				'actions' => array('index'),
				'users' => array('@'),
			),
		);
	}
	*/

}
