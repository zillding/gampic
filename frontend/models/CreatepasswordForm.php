<?php
/**
 * CreatepasswordForm class.
 * CreatepasswordForm is the data structure for keeping
 * user data. It is used by the 'createpasword' action of 'SettingsController'.
 */
class CreatepasswordForm extends CFormModel
{
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
			array('user_password, confirm_user_password', 'required'),
			array('user_password, confirm_user_password', 'length', 'max'=>32, 'min'=>3),
			// confirm the user password
			array('confirm_user_password', 'compare', 'compareAttribute'=>'user_password'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'user_password' => 'Password',
			'confirm_user_password' => 'Confirm Password',
		);
	}

	/**
	 * create user password
	 * @return boolean wether successfully created the password
	 */
	public function create()
	{
		$userId = user()->id;
		// set the record for user gampic
		$userGampic = new UserGampic('register');
		$userGampic->user_id = $userId;
		$userGampic->user_password = $this->user_password;
		// secure the password
		$userGampic->generateHashPassword();
		// set the record for user email

		return $userGampic->save();
	}
}
