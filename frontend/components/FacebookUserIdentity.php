<?php

/**
 * FacebookUserIdentity represents the data needed to identity a facebook user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class FacebookUserIdentity extends CUserIdentity
{
	private $_id; // this is the user id stored in the tbl_user
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$username = $this->username;
		// create a user object based on the content in the database
		$user = User::model()->find('user_name=?', array($username));
		if ($user->userFacebook === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if (!$user->userFacebook->validateFacebookId($this->password)) { // the password here refer to the facebook id
			$this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
		} else {
			$this->_id = $user->user_id;
			$this->username = $user->user_name;
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->_id;
	}

}