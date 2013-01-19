<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $user_id
 * @property string $user_provider
 * @property integer $user_authid
 * @property string $user_name
 * @property string $user_email
 * @property string $user_password
 * @property string $salt
 * @property string $user_reg_date
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Image[] $images
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_password', 'required', 'on'=>'login, register'),
			array('user_email', 'required', 'on'=>'register'),
			// array('user_authid', 'numerical', 'integerOnly'=>true),
			// array('user_provider', 'length', 'max'=>8),
			array('user_name', 'length', 'max'=>25),
			array('user_email', 'length', 'max'=>50),
			array('user_password', 'length', 'max'=>40), // has to be more than 40 due to the hashpassword
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_provider, user_name, user_email, user_reg_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'images' => array(self::HAS_MANY, 'Image', 'user_id'),
			'tblImages' => array(self::MANY_MANY, 'Image', 'tbl_like(user_id, image_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_provider' => 'User Provider',
			'user_authid' => 'User Authid',
			'user_name' => 'User Name',
			'user_email' => 'User Email',
			'user_password' => 'User Password',
			'user_reg_date' => 'User Reg Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models 
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_provider',$this->user_provider,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_reg_date',$this->user_reg_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * validate the password
	 * @param string $password
	 * @return boolean
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password, $this->salt) === $this->user_password;
	}

	/**
	 * encrypt the password
	 * @param string $password
	 * @param string $salt
	 * @return string
	 */
	public function hashPassword($password, $salt)
	{
		return sha1($salt . $password);
	}

	/**
	 * Generate a hash password
	 */
	public function generateHashPassword()
	{
		$this->salt=uniqid('');
		$this->user_password=$this->hashPassword($this->user_password, $this->salt);
	}

}