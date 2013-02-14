<?php

class TwitterController extends Controller
{

	public function actionIndex()
	{

		// create/resume the session
		if (!isset($_SESSION)) {
			session_start();
		}
		// create the twitter model
		$model = new Twitter;

		/**
		 * check the session variable authstate
		 * Values:
		 * - 0: not authed
		 * - 1: request token obtained
		 * - 2: access token obtained
		 *
		 * @var  int The current state of authentication
		 */
		if (isset($_SESSION['authstate'])) {
			if ($_SESSION['authstate'] == 0) {
				// not authed
				if (!$model->getRequestToken()) {
					print 'error';
					Yii::log('cannot get twitter request token', 'error', 'system.web.CController');
				}
			} elseif ($_SESSION['authstate'] == 1) {
				// request token obtained
				if (!$model->getAccessToken()) {
					// error or denied
					Yii::log('cannot get twitter access token', 'error', 'system.web.CController');
					session_destroy();
					$this->redirect('/twitter');

				}

			} elseif ($_SESSION['authstate'] == 2) {
				// access token obtained need to verify
				if ($model->verifyAccessToken()) {
					$twitterId = $_SESSION['access_token']['user_id'];
					if ($model->verifyUser($twitterId)) {
						// the user exists in the db
						unset($_SESSION['twitter_userdata']);
						// the user alr exists log the user in
						if (Twitter::login($twitterId)) {
							$this->redirect('/');
						} else {
							// error
							Yii::log('cannot login local user now', 'error', 'system.web.CController');
						}
						
					} else {
						// first time sign in with twitter
						user()->setFlash('success', '<strong>Well done!</strong> You successfully connected to Twitter as <strong>'.$_SESSION['access_token']['screen_name'].'</strong>');
						// ask the user to select a user name
						$this->render('//register/social', array('model'=>new SocialRegisterForm));
						// Helper::pprint($_SESSION);
					}
				} else {
					print 'access verification failed!';
					Yii::log('cannot verify twitter access token', 'error', 'system.web.CController');
				}
			} else {
				// error
				Yii::log('unexpected authstate session value: '.$_SESSION['authstate'], 'error', 'system.web.CController');
			}
			
		} else {
			// authstate not set
			// not authed
			if ($model->getRequestToken()) {
				// get the url and redirect user to authorize
				header('Location: '.$model->requestUrl);
			} else {
				// error
				Yii::log('cannot get twitter request token', 'error', 'system.web.CController');
			}

		}
	}

	/**
	 * register the twitter user
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
			if($model->validate() && $model->registerTwitter())
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
		return url('twitter/register');
	}
		
	public function actionShow()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		// session_start();
		Helper::pprint($_SESSION);
	}

	public function actionEnd()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		// session_start();
		// Helper::ddie($_SESSION['oauth']);
		session_destroy();
		print 'session cleared';
		// header('Location: '.app()->homeUrl.'register');
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
				'actions' => array('index'),
				'users' => array('@'),
			),
		);
	}

}
?>
