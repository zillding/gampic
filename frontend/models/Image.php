<?php

/**
 * This is the model class for table "tbl_image".
 *
 * The followings are the available columns in table 'tbl_image':
 * @property integer $image_id
 * @property string $image_title
 * @property string $image_extension
 * @property string $image_category
 * @property integer $image_thumb_height
 * @property integer $image_likes
 * @property string $image_upload_time
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $user
 * @property User[] $tblUsers
 */
class Image extends CActiveRecord
{
	const CATEGORY_WARCRAFT=1;
	const CATEGORY_STARCRAFT=2;
	const CATEGORY_DIABLO=3;
	// attribute to store the image file
	public $file;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Image the static model class
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
		return 'tbl_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_title, image_extension, image_category, image_upload_time, user_id', 'required'),
			array('image_thumb_height, image_likes, user_id', 'numerical', 'integerOnly'=>true),
			array('image_title', 'length', 'max'=>50, 'min'=>2),
			array('image_extension', 'in', 'range'=>array('jpg', 'jpeg', 'gif', 'png'), 'allowEmpty'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image_id, image_title, image_extension, image_thumb_height, image_likes, image_upload_time, user_id', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'image_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'tblUsers' => array(self::MANY_MANY, 'User', 'tbl_like(image_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			// 'image_id' => 'Image',
			// 'image_title' => 'Image Title',
			// 'image_extension' => 'Image Extension',
			// 'image_thumb_height' => 'Image Thumb Height',
			// 'image_likes' => 'Image Likes',
			// 'image_upload_time' => 'Image Upload Time',
			// 'user_id' => 'User',
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

		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('image_title',$this->image_title,true);
		$criteria->compare('image_extension',$this->image_extension,true);
		$criteria->compare('image_category',$this->image_category,true);
		$criteria->compare('image_thumb_height',$this->image_thumb_height);
		$criteria->compare('image_likes',$this->image_likes);
		$criteria->compare('image_upload_time',$this->image_upload_time,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}