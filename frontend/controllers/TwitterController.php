<?php

class TwitterController extends Controller
{
	// private $_consumerKey = 'l0v2ziRQal9GRz2d4ETA';
	// private $_consumerSecret = 'uKKfMYwiECQx2B9sAMV8gWR60N9v0LDh0G6B4DV7s4';

	// public function init()
	// {
	// 	Yii::import('ext.tmhOAuth.*');
	// }

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
				// need to ask user to create a local user
				if ($model->verifyAccessToken()) {
					$twitterId = $_SESSION['access_token']['user_id'];
					if ($model->verifyUser($twitterId)) {
						unset($_SESSION['twitter_userdata']);
						// the user alr exists log the user in
						if ($model->loginLocalUser($twitterId)) {
							$this->redirect('/');
						} else {
							// error
							Yii::log('cannot login local user now', 'error', 'system.web.CController');
						}
						
					} else {
						// ask the user to register a local user
						$this->render('index', array('model'=>new RegisterForm));
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
