<?php

/**
 * This is the model class for table "tbl_comment".
 *
 * The followings are the available columns in table 'tbl_comment':
 * @property integer $comment_id
 * @property string $comment_time
 * @property string $comment_content
 * @property integer $user_id
 * @property integer $image_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Image $image
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'tbl_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_time, comment_content, user_id, image_id', 'required'),
			array('user_id, image_id', 'numerical', 'integerOnly'=>true),
			array('comment_content', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comment_content, user_id, image_id', 'safe', 'on'=>'search'),
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
			'image' => array(self::BELONGS_TO, 'Image', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comment_id' => 'Comment',
			'comment_time' => 'Comment Time',
			'comment_content' => 'Comment Content',
			'user_id' => 'User',
			'image_id' => 'Image',
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

		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('comment_time',$this->comment_time,true);
		$criteria->compare('comment_content',$this->comment_content,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('image_id',$this->image_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}