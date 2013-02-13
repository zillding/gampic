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
			'user' => array(self::HAS_ONE, 'User', 'user_id'),
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

		// $criteria=new CDbCriteria;

		// $criteria->compare('user_provider',$this->user_provider,true);
		// $criteria->compare('user_name',$this->user_name,true);
		// $criteria->compare('user_email',$this->user_email,true);
		// $criteria->compare('user_reg_date',$this->user_reg_date,true);

		// return new CActiveDataProvider($this, array(
		// 	'criteria'=>$criteria,
		// ));
	}

}