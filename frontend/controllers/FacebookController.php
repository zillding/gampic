<?php

class FacebookController extends Controller
{
	public function actionIndex()
	{
		// Yii::import('ext.facebook-php-sdk.*');
		// $facebook = new Facebook(array(
		// 	'appId' => '443841368996612',
		// 	'secret' => 'c564e63b5acabc29ec2360f3f97eb452',
		// ));

		// // get user ID
		// $user = $facebook->getUser();

		// if ($user) {
		// 	try {
		// 		// proceed knowing you have a logged in user who's authenticated.
		// 		$user_profile = $facebook->api('/me');
		// 		// Helper::ddie($user_profile);
		// 	} catch (FacebookApiException $e) {
		// 		Yii::log($e, 'error', 'system.web.CController');
		// 		$user = null;
		// 	}
		// }	

		// if ($user) {
		// 	$logoutUrl = $facebook->getLogoutUrl();
		// 	// Helper::ddie('logout: '.$logoutUrl);
		// } else {
		// 	$loginUrl = $facebook->getLoginUrl();
		// 	// header('Location: '.$loginUrl);
		// }

		$this->render('index');
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
