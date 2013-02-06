<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $user_name;
	public $user_password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that user_name and user_password are required,
	 * and user_password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// user_name and user_password are required
			array('user_name, user_password', 'required'),
			// user_name exist
			array('user_name', 'exists'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// user_password needs to be authenticated
			array('user_password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the user_password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			// create a UserIdentity object using the contructor
			$this->_identity=new UserIdentity($this->user_name,$this->user_password);
			if(!$this->_identity->authenticate())
				$this->addError('user_password','Incorrect user_password.');
		}
	}

	/**
	 * check the user name to ensure it exists
	 * This is the 'exists' validator as declared in rules().
	 */
	public function exists($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if (!User::model()->exists('LOWER(user_name)=?', array($this->user_name))) {
				$this->addError('user_name', 'Cannot find this user');
			}
		}
	}

	/**
	 * Logs in the user using the given user_name and user_password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->user_name,$this->user_password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			user()->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}

	public function generateGravatar()
	{
		if (!user()->isGuest) {
			$user=User::model()->find('user_id=:user_id', array('user_id'=>user()->id));
			$userEmailHash = md5(strtolower(trim($user->user_email)));
			return 'http://www.gravatar.com/avatar/'.$userEmailHash.'?s=30';
		}
	}
}
