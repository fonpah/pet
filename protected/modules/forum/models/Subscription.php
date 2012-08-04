<?php

/**
 * This is the model class for table "forum_subscriptions".
 *
 * The followings are the available columns in table 'forum_subscriptions':
 * @property integer $id
 * @property integer $user_id
 * @property integer $forum_id
 * @property integer $topic_id
 * @property string $created
 */
class Subscription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subscription the static model class
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
		return 'forum_subscriptions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, forum_id, topic_id', 'numerical', 'integerOnly'=>true),
			array('created', 'safe'),
        	array('created','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, forum_id, topic_id, created', 'safe', 'on'=>'search'),
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
		'owner'=>array(self::BELONGS_TO,'YumUser','user_id'),
		'topic'=>array(self::BELONGS_TO,'Topic','topic_id'),
		'forum'=>array(self::BELONGS_TO,'Forum','forum_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'forum_id' => 'Forum',
			'topic_id' => 'Topic',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('forum_id',$this->forum_id);
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('created',$this->created,true);
		$criteria->with=array('forum'=>array('with'=>array('parent')),
		                      'topic',
							  'owner');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}