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
			array('user_name', 'unique', 'attributeName'=>'user_name', 'className'=>'User', 'caseSensitive'=>true),
			array('user_email', 'email'),
			array('user_email', 'length', 'max'=>50),
			// restrict the user-input password
			array('user_password', 'length', 'max'=>32, 'min'=>3),
			// confirm the user password
			array('confirm_user_password', 'compare', 'compareAttribute'=>'user_password', 'on'=>'register'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_name, user_email, user_reg_time', 'safe', 'on'=>'search'),
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
		// create the 'main user first'
		$user = new User('register');
		$user->active = 1; // set the default active
		$user->user_name = $this->user_name;
		$user->user_reg_time = new CDbExpression('NOW()');
		$user->user_avatar = 'http://www.gravatar.com/avatar/?s=30'; // set a defaut avatar first
		// register the user in the gampic table (no need to check whether the user has registered
		// since alr checked before)
		if ($user->save()) {
			$userId = $user->primaryKey;
			// set the record for user gampic
			$userGampic = new UserGampic('register');
			$userGampic->user_id = $userId;
			$userGampic->user_password = $this->user_password;
			// secure the password
			$userGampic->generateHashPassword();
			// set the record for user email
			$userEmail = new UserEmail;
			$userEmail->user_id = $userId;
			$userEmail->user_email = $this->user_email;

			if ($userGampic->save() && $userEmail->save()) {
				// update the user avatar
				$user->user_avatar=UserIdentity::generateGravatar($userEmail->user_email); 
				$user->save();

				// automatically log the user in
				$model=new LoginForm;
				$model->user_name=$user->user_name;
				$model->user_password=$this->user_password;
				return $model->login();

			} else {
				Yii::log('cannot register local user and email at this time', 'error', 'system.web.CFormModel');
				return false;
			}
		} else {
			Yii::log('cannot register at this time', 'error', 'system.web.CFormModel');
			return false;
		}
	}
}
