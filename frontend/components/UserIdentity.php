<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id; // this is the user id stored in the tbl_user
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$username = strtolower($this->username);
		// create a user object based on the content in the database
		$user = User::model()->find('LOWER(user_name)=?', array($username));
		if ($user === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if (!$user->validatePassword($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else {
			$this->_id = $user->user_id;
			$this->username = $user->user_name;
			$this->setState('avatar', UserIdentity::generateGravatar($this->_id)); // store the current user avatar in thte user state
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->_id;
	}

	// generate the user gravatar
	public static function generateGravatar($userId)
	{
		$userEmailHash = md5(strtolower(trim(User::model()->findByPk($userId)->user_email)));
		return 'http://www.gravatar.com/avatar/'.$userEmailHash.'?s=30';
	}
}