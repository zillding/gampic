<?php
/**
 * FB model
 * the 'Facebook' name is taken by the sdk
 */
Class FB
{
	private $_appId = '443841368996612';
	private $_appSecret = 'c564e63b5acabc29ec2360f3f97eb452';
	private $_user;

	public $facebook;
	public $isGuest;

	public function __construct()
	{
		Yii::import('ext.facebook-php-sdk.*');
		$this->facebook = new Facebook(array(
			'appId' => $this->_appId,
			'secret' => $this->_appSecret,
		));

		$this->_user = $this->facebook->getUser();
		$this->setStatus($this->_user);

		if (!$this->isGuest) {
			try {
				$_SESSION['userProfile'] = $this->facebook->api('/me');
			} catch (FacebookApiException $e) {
				Yii::log($e, 'error', 'system.web.CModel');
				$this->_user = null;
			}
		}
	}

	/**
	 * helper function to set the user login status
	 * @param object $user the user object get from the fb sdk
	 */
	private function setStatus($user)
	{
		if ($user) {
			$this->isGuest = false;
		} else {
			$this->isGuest = true;
		}
	}

	/**
	 * redirect to fb to login user
	 */
	public function FBLogin()
	{
		$loginUrl = $this->facebook->getLoginUrl();
		header('Location: '.$loginUrl);
	}

	/**
	 * get facebook id
	 * @return integer facebook id
	 */
	public function getFacebookId()
	{
		return $_SESSION['userProfile']['id'];
	}

	/**
	 * get the user name in facebook
	 * @return string the facebook name
	 */
	public function getFacebookName()
	{
		return $_SESSION['userProfile']['name'];
	}

	/**
	 * verify whether the facebook user exist in the user database
	 * @param  integer $facebookId facebook id
	 * @return boolean whether the user has registered in the local app
	 */
	public function verifyUser($facebookId)
	{
		return UserFacebook::model()->exists('facebook_id='.$facebookId);
	}

	/**
	 * login the local user
	 * @param  int $facebookId facebook id
	 * @return boolean whether the login is successful
	 */
	public static function login($facebookId)
	{
		$user = UserFacebook::model()->find('facebook_id=?', array($facebookId))->user;

		$identity=new FacebookUserIdentity($user->user_name, $facebookId);

		if($identity->authenticate())
		{
			user()->login($identity,0);
			return true;
		}
		else
			return false;
	}

}

?>
