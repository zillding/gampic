<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * user register form data. It is used by the 'register' action of 'RegisterController'.
 */
class RegisterForm extends CFormModel
{
	public $user_name;
	public $user_email;
	public $user_password;
	public $confirm_user_password;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('user_name, user_email, user_password', 'required'),
			array('confirm_user_password', 'required', 'on'=>'register'),
			// array('user_authid', 'numerical', 'integerOnly'=>true),
			// array('user_provider', 'length', 'max'=>8),
			array('user_name', 'length', 'max'=>25, 'min'=>2),
			// user name need to be checked
			array('user_name', 'unique', 'attributeName'=>'user_name', 'className'=>'User'),
			array('user_email', 'email'),
			array('user_email', 'length', 'max'=>50),
			// restrict the user-input password
			array('user_password', 'length', 'max'=>32, 'min'=>3),
			// confirm the user password
			array('confirm_user_password', 'compare', 'compareAttribute'=>'user_password', 'on'=>'register'),
			// array('confirm_user_password', 'confirmed'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_provider, user_name, user_email, user_reg_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'user_name' => 'Username',
			'user_email' => 'Email',
			'user_password' => 'Password',
			'confirm_user_password' => 'Confirm Password',
		);
	}

	/**
	 * register the user 
	 * @return boolean whether register is successful
	 */
	public function register()
	{
		// create a new user based on the data collected by the register form
		$user=new User('register');
		$user->attributes=$this->attributes;
		// secure the password
		$user->generateHashPassword();
		$user->user_reg_time=new CDbExpression('NOW()');
		// todo: need to change when fb and twitter is used
		$user->user_authid=1;
		// register the user (no need to check whether the user has registered
		// since alr checked before)
		if ($user->save()) {
			$model=new LoginForm;
			$model->user_name=$user->user_name;
			$model->user_password=$this->user_password;
			return $model->login();
		} else {
			// print_r($user->getErrors()); // for debugging
			print 'could not register at this time';
			return false;
		}
	}
}
