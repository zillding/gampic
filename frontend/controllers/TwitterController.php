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
		session_start();
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
				if (!$model->getAccessToken()) 
					// error
					Yii::log('cannot get twitter access token', 'error', 'system.web.CController');
			} elseif ($_SESSION['authstate'] == 2) {
				// access token obtained need to verify
				// need to ask user to create a local user
				if ($model->verifyAccessToken()) {
					// Yii::log(je($_SESSION), 'info', 'system.web.test');
					// Yii::log(je($model->userdata), 'info', 'system.web.test');
					$this->render('index', array('model'=>new RegisterForm));
					Helper::pprint($_SESSION);
					Helper::pprint($model->userdata);
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

		/*
		$tmhOAuth = new tmhOAuth(array(
			'consumer_key'    => $this->_consumerKey,
			'consumer_secret' => $this->_consumerSecret,
		));

		$here = tmhUtilities::php_self();
		$_SESSION = new CHttpSession;
		$_SESSION->open();

		$params = array('oauth_callback' => $here,
			'x_auth_access_type' => 'write');

		$code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token',''), $params);

		if ($code == 200) {
			$_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
			$authurl = $tmhOAuth->url('oauth/authorize', '').'?oauth_token='.$_SESSION['oauth']['oauth_token'];
			Helper::ddie($_SESSION['oauth']);
			header('Location: '.$authurl);
		} else {
			outputError($tmhOAuth);
		}
		*/
		
	public function actionShow()
	{
		session_start();
		Helper::pprint($_SESSION);
	}


	public function actionEnd()
	{
		session_start();
		// Helper::ddie($_SESSION['oauth']);
		session_destroy();
		print 'session cleared';
		// header('Location: '.app()->homeUrl.'register');
	}

}
?>
