<?php

/**
 * This is the model class for table "photo".
 *
 * The followings are the available columns in table 'photo':
 * @property integer $id
 * @property string $filename
 * @property integer $pet_id
 * @property integer $user_id
 * @property integer $album_id
 * @property string $created
 */
class Photo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photo the static model class
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
		return 'photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename', 'required'),
			array('pet_id, user_id, album_id', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>100),
			array('created', 'safe'),
			array('created','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, filename, pet_id, user_id, album_id, created', 'safe', 'on'=>'search'),
		);
	}
	
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		Yii::import('application.modules.pet.models.*');
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		  'pet'=>array(self::BELONGS_TO,'Pet','pet_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'filename' => 'Filename',
			'pet_id' => 'Pet',
			'user_id' => 'User',
			'album_id' => 'Album',
			'created' => 'Created',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('pet_id',$this->pet_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}