<?php

/**
 * This is the model class for table "tbl_user_twitter".
 *
 * The followings are the available columns in table 'tbl_user_twitter':
 * @property integer $user_id
 * @property integer $active
 * @property integer $twitter_id
 * @property string $oauth_token
 * @property string $oauth_secret
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserTwitter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserTwitter the static model class
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
			array('user_id, twitter_id, oauth_token, oauth_secret', 'required'),
			array('user_id, active, twitter_id', 'numerical', 'integerOnly'=>true),
			array('oauth_token, oauth_secret', 'length', 'max'=>127),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, active, twitter_id', 'safe', 'on'=>'search'),
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
			'twitter_id' => 'Twitter',
			'oauth_token' => 'Oauth Token',
			'oauth_secret' => 'Oauth Secret',
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
		$criteria->compare('twitter_id',$this->twitter_id);
		$criteria->compare('oauth_token',$this->oauth_token,true);
		$criteria->compare('oauth_secret',$this->oauth_secret,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * validate the user based on the twitter id
	 */
	public function validateTwitterId($twitterId)
	{
		return $this->twitter_id == $twitterId;
	}
}