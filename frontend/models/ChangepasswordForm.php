<?php
/**
 * ChangepasswordForm class.
 * ChangepasswordForm is the data structure for keeping
 * user password. It is used by the 'edit' action of 'SettingsController'.
 */
class ChangepasswordForm extends CFormModel
{
	public $old_password;
	public $new_password;
	public $confirm_new_password;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('old_password, new_password, confirm_new_password', 'required'),
			array('old_password, new_password, confirm_new_password', 'length', 'max'=>32, 'min'=>3),
			// confirm the user password
			array('confirm_new_password', 'compare', 'compareAttribute'=>'new_password'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'old_password' => 'Old Password',
			'new_password' => 'New Password',
			'confirm_user_password' => 'Confirm Password',
		);
	}

	public function change()
	{
		# code...
	}

	/*
	public function change()
	{
		// user
		$user = User::model()->findByPk(user()->id);
		$user->user_name = trim($this->user_name);
		if ($user->save()) {
			// user email
			if (!TypeValidator::isEmpty($this->user_email)) {
				if (!$userEmail = $user->userEmail) {
					$userEmail = new UserEmail;
					$userEmail->user_id = user()->id;
				}
				$userEmail->user_email = $this->user_email;
				if (!$userEmail->save()) return false;
			}

			// user info
			if (!(TypeValidator::isEmpty($this->first_name) && TypeValidator::isEmpty($this->last_name) && TypeValidator::isEmpty($this->gender))) {
				if (!$userInfo = $user->userInfo) {
					$userInfo = new UserInfo;
					$userInfo->user_id = user()->id;
				}
				$userInfo->first_name = trim($this->first_name);
				$userInfo->last_name = trim($this->last_name);
				$userInfo->gender = trim($this->gender);
				if(!$userInfo->save()) {
					return false;
				}
			}
			return true;
		}
		return false;
	}
	*/
}
