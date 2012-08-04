<?php

/**
 * This is the model class for table "pets".
 *
 * The followings are the available columns in table 'pets':
 * @property integer $id
 * @property string $name
 * @property string $date_of_birth
 * @property string $gender
 * @property string $story
 * @property integer $user_id
 * @property string $avatar
 * @property string $favorite_feed
 * @property string $favorite_toy
 * @property string $favorite_game_art
 * @property string $breeder
 * @property string $pedigree
 * @property string $status
 * @property integer $category_id
 * @property string $created
 * @property string $nickname
 * @property integer $race_id
 * @property string $veterinarian
 * @property string $club
 * @property string $modified
 */
class Pet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pet the static model class
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
		return 'pets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, date_of_birth, gender, nickname', 'required'),
			array('user_id, category_id, race_id', 'numerical', 'integerOnly'=>true),
			array('name, favorite_feed, favorite_toy, favorite_game_art, breeder, pedigree, status', 'length', 'max'=>40),
			array('gender', 'length', 'max'=>1),
			array('story', 'length', 'max'=>250),
			array('avatar', 'length', 'max'=>150),
			array('nickname, veterinarian, club', 'length', 'max'=>50),
			array('avatar', 'file', 'types'=>'jpg, gif, png','on'=>'removeAvatar'),
			array('avatar','default','value'=>'','setOnEmpty'=>true),
			array('created, modified', 'safe'),
			array('modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'update,removeAvatar'),
        	array('created,modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, date_of_birth, gender, story, user_id,  favorite_feed, favorite_toy, favorite_game_art, breeder, pedigree, status, category_id, created, nickname, race_id, veterinarian, club', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		Yii::import('application.modules.gallery.models.*');
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		  'owner'=>array(
		  	self::BELONGS_TO,'YumUser','user_id'
		  ),
		  'photo'=>array(self::HAS_MANY,'Photo','pet_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'date_of_birth' => 'Date Of Birth',
			'gender' => 'Gender',
			'story' => 'Story',
			'user_id' => 'User',
			'avatar' => 'Avatar',
			'favorite_feed' => 'Favorite Feed',
			'favorite_toy' => 'Favorite Toy',
			'favorite_game_art' => 'Favorite Game Art',
			'breeder' => 'Breeder',
			'pedigree' => 'Pedigree',
			'status' => 'Status',
			'category_id' => 'Category',
			'created' => 'Created',
			'modified' => 'Modified',
			'nickname' => 'Nickname',
			'race_id' => 'Race',
			'veterinarian' => 'Veterinarian',
			'club' => 'Club',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('story',$this->story,true);
		$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('favorite_feed',$this->favorite_feed,true);
		$criteria->compare('favorite_toy',$this->favorite_toy,true);
		$criteria->compare('favorite_game_art',$this->favorite_game_art,true);
		$criteria->compare('breeder',$this->breeder,true);
		$criteria->compare('pedigree',$this->pedigree,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('race_id',$this->race_id);
		$criteria->compare('veterinarian',$this->veterinarian,true);
		$criteria->compare('club',$this->club,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}