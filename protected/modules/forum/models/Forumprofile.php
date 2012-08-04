<?php

/**
 * This is the model class for table "forum_profiles".
 *
 * The followings are the available columns in table 'forum_profiles':
 * @property integer $id
 * @property integer $user_id
 * @property string $signature
 * @property string $signatureHtml
 * @property string $locale
 * @property string $timezone
 * @property integer $totalPosts
 * @property integer $totalTopics
 * @property string $currentLogin
 * @property string $lastLogin
 * @property string $created
 * @property string $modified
 */
class Forumprofile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Forumprofile the static model class
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
		return 'forum_profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('signature, signatureHtml', 'required'),
			array('user_id, totalPosts, totalTopics', 'numerical', 'integerOnly'=>true),
			array('signature', 'length', 'max'=>255),
			array('locale', 'length', 'max'=>3),
			array('timezone', 'length', 'max'=>4),
			array('modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'update'),
        	array('created,modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'insert'),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, signature, signatureHtml, locale, timezone, totalPosts, totalTopics, currentLogin, lastLogin, created, modified', 'safe', 'on'=>'search'),
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
		  'user'=>array(self::BELONGS_TO,'YumUser','user_id'),
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
			'signature' => 'Signature',
			'signatureHtml' => 'Signature Html',
			'locale' => 'Locale',
			'timezone' => 'Timezone',
			'totalPosts' => 'Total Posts',
			'totalTopics' => 'Total Topics',
			'currentLogin' => 'Current Login',
			'lastLogin' => 'Last Login',
			'created' => 'Created',
			'modified' => 'Modified',
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
		$criteria->compare('signature',$this->signature,true);
		$criteria->compare('signatureHtml',$this->signatureHtml,true);
		$criteria->compare('locale',$this->locale,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('totalPosts',$this->totalPosts);
		$criteria->compare('totalTopics',$this->totalTopics);
		$criteria->compare('currentLogin',$this->currentLogin,true);
		$criteria->compare('lastLogin',$this->lastLogin,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}