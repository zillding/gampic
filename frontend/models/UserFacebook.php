<?php

/**
 * This is the model class for table "tbl_user_facebook".
 *
 * The followings are the available columns in table 'tbl_user_facebook':
 * @property integer $user_id
 * @property integer $active
 * @property integer $facebook_id
 * @property string $access_token
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserFacebook extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFacebook the static model class
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
		return 'tbl_user_facebook';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, facebook_id, access_token', 'required'),
			array('user_id, active, facebook_id', 'numerical', 'integerOnly'=>true),
			array('access_token', 'length', 'max'=>127),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, active, facebook_id, access_token', 'safe', 'on'=>'search'),
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
			'active' => 'Active',
			'facebook_id' => 'Facebook',
			'access_token' => 'Access Token',
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
		$criteria->compare('facebook_id',$this->facebook_id);
		$criteria->compare('access_token',$this->access_token,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}