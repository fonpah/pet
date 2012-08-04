<?php

/**
 * This is the model class for table "forum_topics".
 *
 * The followings are the available columns in table 'forum_topics':
 * @property integer $id
 * @property integer $forum_id
 * @property integer $user_id
 * @property string $title
 * @property string $slug
 * @property integer $status
 * @property integer $type
 * @property integer $post_count
 * @property integer $view_count
 * @property integer $firstPost_id
 * @property integer $lastPost_id
 * @property integer $lastUser_id
 * @property string $created
 * @property string $modified
 */
class Topic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Topic the static model class
	 */
	 
	 /**
	 * Type constants.
	 */
	const NORMAL = 0;
	const STICKY = 1;
	const IMPORTANT = 2;
	const ANNOUNCEMENT = 3;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'forum_topics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('forum_id, user_id, status, type, post_count, view_count, firstPost_id, lastPost_id, lastUser_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('slug', 'length', 'max'=>110),
			array('created, modified', 'safe'),
			array('modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'update'),
        	array('created,modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, forum_id, user_id, title, slug, status, type, post_count, view_count, firstPost_id, lastPost_id, lastUser_id, created, modified', 'safe', 'on'=>'search'),
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
		'forum'=> array(self::BELONGS_TO,'Forum','forum_id'),
		'post'=>array(self::HAS_MANY,'Post','topic_id'),
		'lastPost'=>array(self::BELONGS_TO,'Post','lastPost_id'),
		'firstPost'=>array(self::BELONGS_TO,'Post','firstPost_id'),
		'lastUser'=>array(self::BELONGS_TO,'YumUser','lastUser_id'),
		'sucbricription'=>array(self::HAS_MANY,'Subscription','topic_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'forum_id' => 'Forum',
			'user_id' => 'User',
			'title' => 'Title',
			'slug' => 'Slug',
			'status' => 'Status',
			'type' => 'Type',
			'post_count' => 'Post Count',
			'view_count' => 'View Count',
			'firstPost_id' => 'First Post',
			'lastPost_id' => 'Last Post',
			'lastUser_id' => 'Last User',
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
		$criteria->compare('forum_id',$this->forum_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type);
		$criteria->compare('post_count',$this->post_count);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('firstPost_id',$this->firstPost_id);
		$criteria->compare('lastPost_id',$this->lastPost_id);
		$criteria->compare('lastUser_id',$this->lastUser_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->with=array('lastPost','forum','user');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTopicsByForum($forum_id){
		$criteria = new CDbCriteria;
		$criteria->condition= 'topic.forum_id=:forum_id';
		$criteria->params = array(':forum_id'=>$forum_id);
		$criteria->alias='topic';
		$criteria->with=array(	'lastPost'=>array('select'=>'id,content,created,modified'),
								'lastUser'=>array('select'=>'id,username,createtime'),
								'user'=>array('select'=>'id,username, createtime')
			);
	 	$criteria->together=true;
			return new CActiveDataProvider($this,array('criteria'=>$criteria));
		}
	/**
	 * Behaviors for this model
	 */
	public function behaviors(){
	  return array(
	    'sluggable' => array(
	      'class'=>'application.extensions.sluggable.SluggableBehavior',
	      'columns' => array('title'),
	      'unique' => true,
	      'update' => true,
	    ),
	  );
	}
	
	protected function afterSave(){
		if(parent::afterSave()){
			if($this->isNewRecord){
								$forumprofile = Forumprofile::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId()));
								$c = count($this->findAll('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId())));
								$forumprofile->totalTopics=isset($c)? $c: 0;
								$forumprofile->save();

				return true;
			}
		}
		else{
			return false;
		}
	}
}