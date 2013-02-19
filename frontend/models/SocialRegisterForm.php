<?php
/**
 * SocialRegisterForm class.
 * SocialRegisterForm is the data structure for keeping
 * user register username form data. It is used by the 'register' action of 'RegisterController'.
 */
class SocialRegisterForm extends CFormModel
{
	public $user_name;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('user_name', 'required'),
			array('user_name', 'length', 'max'=>25, 'min'=>2),
			// user name need to be checked
			array('user_name', 'unique', 'attributeName'=>'user_name', 'className'=>'User', 'caseSensitive'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'user_name' => 'Username',
		);
	}

	/**
	 * register the user 
	 * @return boolean whether register is successful
	 */
	public function registerTwitter()
	{
		$user = $this->createDefaultUser();
		// register the user in the gampic table (no need to check whether the user has registered
		// since alr checked before)
		if ($user->save()) {
			$userId = $user->primaryKey;

			// store the twitter user info
			if (!isset($_SESSION)) {
				session_start();
			}
			$twitterUser = new UserTwitter;
			$twitterUser->user_id = $userId;
			$twitterUser->twitter_id = $_SESSION['access_token']['user_id'];
			$twitterUser->oauth_token = $_SESSION['access_token']['oauth_token'];
			$twitterUser->oauth_secret = $_SESSION['access_token']['oauth_token_secret'];

			if ($twitterUser->save()) {
				// update the user profile pic
				$user->user_avatar = 'https://api.twitter.com/1/users/profile_image?screen_name='.$_SESSION['access_token']['screen_name'].'&size=bigger';
				if ($user->save()) {
					// shoudl unset part only
					// unset($_SESSION['twitter_userdata']);
					// log in the user
					return Twitter::login($twitterUser->twitter_id);
				}
			}

		}
		
		Yii::log('cannot register at this time', 'error', 'system.web.CFormModel');
		return false;
	}

	/**
	 * register the facebook user
	 * @return boolean whether the registration is successful
	 */
	public function registerFacebook()
	{
		$user = $this->createDefaultUser();

		if ($user->save()) {
			$userId = $user->primaryKey;

			if (!isset($_SESSION)) {
				session_start();
			}
			$facebookUser = new UserFacebook;
			$facebookUser->user_id = $userId;
			$facebookUser->facebook_id = (int) $this->getFacebookParam($_SESSION, 'user_id');
			$facebookUser->access_token = $this->getFacebookParam($_SESSION, 'access_token');

			if ($facebookUser->save()) {
				// update the user profile pic
				$user->user_avatar = 'http://graph.facebook.com/'.$_SESSION['userProfile']['username'].'/picture?width=100&height=100';
				if ($user->save()) {
					return FB::login($facebookUser->facebook_id);
				}
			}
		}

		Yii::log('cannot register at this time', 'error', 'system.web.CFromModel');
		return false;
	}

	/**
	 * a helper function to create a default local user
	 * @return object User
	 */
	private function createDefaultUser()
	{
		// create a new user based on the data collected by the register form
		// create the 'main user first'
		$user = new User('register');
		$user->active = 1; // set the default active
		$user->user_name = $this->user_name;
		$user->user_reg_time = new CDbExpression('NOW()');
		$user->user_avatar = 'http://www.gravatar.com/avatar/?s=30'; // set a defaut avatar first
		return $user;
	}

	/**
	 * helper function to find the facebook param in the given array
	 * by checking the pattern of the key
	 * @param  array $array the array containing the param
	 * @return string the string format of the param
	 */
	private function getFacebookParam($array, $param)
	{
		$pattern = '/^fb_[0-9]+_'.$param.'$/';
		foreach ($array as $key => $value) {
			if (preg_match($pattern, $key)) {
				Yii::log($value, 'info', 'system.web.test');
				return $value;
			}
		}
	}

}
