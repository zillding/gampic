<?php

/**
 * This is the model class for table "tbl_user_gampic".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $user_id
 * @property string $user_password
 * @property string $salt
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Image[] $images
 */
class UserGampic extends CActiveRecord
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
		return 'tbl_user_gampic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_password', 'length', 'max'=>40), // has to be more than 40 due to the hashpassword
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			// array('user_name, user_reg_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::HAS_ONE, 'User', 'user_id'),
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
			'user_password' => 'User Password',
			'salt' => 'Salt',
		);
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