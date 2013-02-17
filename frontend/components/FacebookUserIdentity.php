<?php

/**
 * FacebookUserIdentity represents the data needed to identity a facebook user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class FacebookUserIdentity extends CComponent implements IUserIdentity
{
	private $_userId; // this is the user id stored in the tbl_user
	private $_userName;
	private $_facebookId;
	private $_isAuthenticated;

	public function __construct($userName, $facebookId)
	{
		$this->_userName = $userName;
		$this->_facebookId = $facebookId;
	}
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$userName = $this->_userName;
		// create a user object based on the content in the database
		$user = User::model()->find('user_name=?', array($userName));
		if ($user->userFacebook === null)
			$this->_isAuthenticated = false;
		else if (!$user->userFacebook->validateFacebookId($this->_facebookId)) { 
			$this->_isAuthenticated = false;
		} else {
			$this->_userId = $user->user_id;
			$this->_userName = $user->user_name;
			$this->_isAuthenticated = true;
			return true;
		}
		return false;
	}

	public function getId()
	{
		return $this->_userId;
	}

	public function getIsAuthenticated()
	{
		return $this->_isAuthenticated;
	}

	public function getName()
	{
		return $this->_userName;
	}

	public function getPersistentStates()
	{
		return array();
	}

}