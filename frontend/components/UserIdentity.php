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
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// create a user object based on the content in the database
		$userGampic = User::model()->find('user_name=?', array($this->username))->userGampic;
		if ($userGampic === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if (!$userGampic->validatePassword($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else {
			$this->_id = $userGampic->user_id;
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->_id;
	}

	// generate the user gravatar, this is the default avatar
	// depend on the email
	public static function generateGravatar($email)
	{
		$userEmailHash = md5(strtolower(trim($email)));
		return 'http://www.gravatar.com/avatar/'.$userEmailHash.'?s=100';
	}
}