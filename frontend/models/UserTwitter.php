<?php

/**
 * This is the model class for table "tbl_user_twitter".
 *
 * The followings are the available columns in table 'tbl_user_twitter':
 * @property integer $id
 * @property integer $user_id
 * @property integer $twitter_id
 * @property string $oauth_token
 * @property string $oauth_secret
 *
 * The followings are the available model relations:
 * @property User[] $user
 */
class UserTwitter extends CActiveRecord
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
		return 'tbl_user_twitter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models 
	 * based on the search/filter conditions.
	 */
	public function search()
	{
	}

	/**
	 * validate the twitter id
	 * @param string $twitterId
	 * @return boolean
	 */
	public function validateTwitterId($twitterId)
	{
		return $this->twitter_id === $twitterId;
	}

}