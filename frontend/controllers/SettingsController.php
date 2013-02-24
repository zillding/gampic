<?php

class SettingsController extends Controller
{
	public $user; // store the user activerecord in tbl_user
	public $connectToTwitter; // status whether the user connect to twitter
	public $connectToFacebook; // status whether the user connect to facebook

	public $createpasswordFormAction; // store the url later passed to createpasswordForm model

	public function init()
	{
		regCssFile('zocial');
		regLessFile('form');
		regLessFile('settings');
		regJsFile('form');
		regJsFile('settings');

		$this->user = User::model()->findByPk(user()->id);
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

	public function actionDisconnectFacebook()
	{
		if ($this->user->userGampic || $this->user->userTwitter) {
			echo UserFacebook::model()->deleteByPk(user()->id);
		} else {
			// should ask user to create a local password
			$this->createpasswordFormAction = url("/settings/disconnectFacebook");
			$model = new CreatepasswordForm;

			// collect user input data
			if(isset($_POST['CreatepasswordForm']))
			{
				$model->attributes = $_POST['CreatepasswordForm'];

				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->create()) {
					if (UserFacebook::model()->deleteByPk(user()->id)) {
						user()->setFlash('success', '<strong>Congratulations!</strong> You have successfully created your password and disconnect to Facebook!');
						$this->redirect(url('/settings'));
					}
				}
			}

			$this->render('createpassword',array('model'=>$model));
		}
		
	}

	public function actionDisconnectTwitter()
	{
		if ($this->user->userGampic || $this->user->userFacebook) {
			// allow disconnect
			echo UserTwitter::model()->deleteByPk(user()->id);
		} else{
			// should ask user to create a local password
			$this->createpasswordFormAction = url("/settings/disconnectTwitter");
			$model = new CreatepasswordForm;

			// collect user input data
			if(isset($_POST['CreatepasswordForm']))
			{
				$model->attributes = $_POST['CreatepasswordForm'];

				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->create()) {
					if (UserTwitter::model()->deleteByPk(user()->id)) {
						user()->setFlash('success', '<strong>Congratulations!</strong> You have successfully created your password and disconnect to Twitter!');
						$this->redirect(url('/settings'));
					}
				}
			}

			$this->render('createpassword',array('model'=>$model));

		}
	}

	public function actionChangepassword()
	{
		$model=new ChangepasswordForm;

		// if it is ajax validation request
		// if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
		// {
		// 	echo CActiveForm::validate($model);
		// 	app()->end();
		// } 

		// collect user input data
		if(isset($_POST['ChangepasswordForm']))
		{
			$model->attributes = $_POST['ChangepasswordForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->change()) {
				user()->setFlash('success', '<strong>Congratulations!</strong> You have successfully changed your password!');
				$this->redirect(url('/settings'));
			}
		}

		$this->render('changepassword',array('model'=>$model));
	}

	public function actionCreatepassword()
	{
		$this->createpasswordFormAction = url("/settings/createpassword");
		$model = new CreatepasswordForm;

		// if it is ajax validation request
		// if(isset($_POST['ajax']) && $_POST['ajax']==='createpassword-form')
		// {
		// 	echo CActiveForm::validate($model);
		// 	app()->end();
		// } 

		// collect user input data
		if(isset($_POST['CreatepasswordForm']))
		{
			$model->attributes = $_POST['CreatepasswordForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->create()) {
				user()->setFlash('success', '<strong>Congratulations!</strong> You have successfully created your password!');
				$this->redirect(url('/settings'));
			}
		}

		$this->render('createpassword',array('model'=>$model));
	}

	public function actionGetGravatarProfileImage()
	{
		$email = isset($this->user->userEmail) ? $this->user->userEmail->user_email : "";
		$src = UserIdentity::generateGravatar($email);
		if ($this->changeAvatar($src)) {
			echo $src;
		}
	}

	public function actionGetTwitterProfileImage()
	{
		if ($this->user->userTwitter) {
			$src = 'https://api.twitter.com/1/users/profile_image?screen_name='.$_SESSION['access_token']['screen_name'].'&size=bigger';
			if ($this->changeAvatar($src)) {
				echo $src;
			}
		}
	}

	public function actionGetFacebookProfileImage()
	{
		if ($this->user->userFacebook) {
			$src = 'https://graph.facebook.com/'.$_SESSION['userProfile']['username'].'/picture?width=100&height=100';
			if ($this->changeAvatar($src)) {
				echo $src;
			}
		}
	}

	private function changeAvatar($imageUrl)
	{
		$this->user->user_avatar = $imageUrl;
		if ($this->user->save()) {
			return true;
		} else {
			return false;
		}
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
			if ($this->user->userGampic || $this->user->userFacebook) {
				return $this->renderPartial('_disconnectButton', array('serviceName'=>'Twitter'), true);
			} else {
				return "<a href='/settings/disconnectTwitter' class='btn btn-danger disconnectTwitter'><i class='icon-remove-sign icon-white'></i> Disconnect</a>";
			}
		} else {
			return '<a href="/twitter" class="zocial twitter">Connect</a>';
		}
	}

	public function facebookConnectButton()
	{
		if ($this->connectToFacebook) {
			if ($this->user->userGampic || $this->user->userTwitter) {
				return $this->renderPartial('_disconnectButton', array('serviceName'=>'Facebook'), true);
			} else {
				return "<a href='/settings/disconnectFacebook' class='btn btn-danger disconnectFacebook'><i class='icon-remove-sign icon-white'></i> Disconnect</a>";
			}
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