<?php

class SettingsController extends Controller
{
	public $connectToTwitter; // status whether the user connect to twitter
	public $connectToFacebook; // status whether the user connect to facebook

	public function init()
	{
		regCssFile('zocial');
		regLessFile('form');
		regJsFile('form');
		regJsFile('settings');

		// set the user status
		$this->connectToTwitter = $this->connectToTwitter();
		$this->connectToFacebook = $this->connectToFacebook();

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
			$model->attributes = $_POST['ProfileForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->save()) {
				user()->setFlash('success', '<strong>Congratulations!</strong> You have successfully updated your profile!');
				$this->redirect(url('/dashboard'));
			}
		}

		$this->render('index',array('model'=>$model));

	}

	/**
	 * check whether the user connect to twitter
	 * @return boolean whether the user connect to twitter
	 */
	private function connectToTwitter()
	{
		$twitterUser = User::model()->findByPk(user()->id)->userTwitter;
		if ($twitterUser) {
			if ($twitterUser->active) {
				return true;
			}
		}
		return false;
	}

	private function connectToFacebook()
	{
		$facebookUser = User::model()->findByPk(user()->id)->userFacebook;
		if ($facebookUser) {
			if ($facebookUser->active) {
				return true;
			}
		}
		return false;
	}

	/**
	 * show the twitter connect button
	 * if user alr connected to twitter show 'disconnect'
	 * @return string the html mark up for the button
	 */
	public function twitterConnectButton()
	{
		if ($this->connectToTwitter) {
			return "<a class='btn btn-danger' href='/settings/disconnectTwitter'>Disconnect</a>";
		} else {
			return '<a href="/twitter" class="zocial twitter">Connect</a>';
		}
	}

	public function facebookConnectButton()
	{
		if ($this->connectToFacebook) {
			return "<a class='btn btn-danger' href='/settings/disconnectFacebook'>Disconnect</a>";
		} else {
			return '<a href="/facebook" class="zocial facebook">Connect</a>';
		}
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