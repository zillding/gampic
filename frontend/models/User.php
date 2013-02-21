<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $user_id
 * @property integer $active
 * @property string $user_name
 * @property string $user_reg_time
 * @property string $user_avatar
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Image[] $images
 * @property Image[] $tblImages
 * @property UserEmail $userEmail
 * @property UserFacebook $userFacebook
 * @property UserGampic $userGampic
 * @property UserInfo $userInfo
 * @property UserTwitter $userTwitter
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
			array('user_reg_time, user_avatar', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>25),
			array('user_avatar', 'length', 'max'=>127),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, active, user_name, user_reg_time, user_avatar', 'safe', 'on'=>'search'),
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
			'userEmail' => array(self::HAS_ONE, 'UserEmail', 'user_id'),
			'userFacebook' => array(self::HAS_ONE, 'UserFacebook', 'user_id'),
			'userGampic' => array(self::HAS_ONE, 'UserGampic', 'user_id'),
			'userInfo' => array(self::HAS_ONE, 'UserInfo', 'user_id'),
			'userTwitter' => array(self::HAS_ONE, 'UserTwitter', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'active' => 'Active',
			'user_name' => 'User Name',
			'user_reg_time' => 'User Reg Time',
			'user_avatar' => 'User Avatar',
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
		$criteria->compare('active',$this->active);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_reg_time',$this->user_reg_time,true);
		$criteria->compare('user_avatar',$this->user_avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}