<?php

/**
 * This is the model class for table "tbl_user_gampic".
 *
 * The followings are the available columns in table 'tbl_user_gampic':
 * @property integer $user_id
 * @property string $user_password
 * @property string $salt
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserGampic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserGampic the static model class
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
			array('user_id, user_password, salt', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('user_password', 'length', 'max'=>40),
			array('salt', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('salt',$this->salt,true);

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