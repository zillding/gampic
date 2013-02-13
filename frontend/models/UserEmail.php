<?php

/**
 * This is the model class for table "tbl_user_email".
 *
 * The followings are the available columns in table 'tbl_user_email':
 * @property integer $user_id
 * @property string $user_email
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Image[] $images
 */
class UserEmail extends CActiveRecord
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
		return 'tbl_user_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_email', 'length', 'max'=>50),
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
			'user_email' => 'User Email',
		);
	}

}