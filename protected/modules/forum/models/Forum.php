<?php

/**
 * This is the model class for table "forum_forums".
 *
 * The followings are the available columns in table 'forum_forums':
 * @property integer $id
 * @property integer $forum_id
 * @property integer $access_level_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $status
 * @property integer $orderNo
 * @property integer $topic_count
 * @property integer $post_count
 * @property integer $accessRead
 * @property integer $accessPost
 * @property integer $accessPoll
 * @property integer $accessReply
 * @property integer $settingPostCount
 * @property integer $settingAutoLock
 * @property integer $lastTopic_id
 * @property integer $lastPost_id
 * @property integer $lastUser_id
 * @property string $created
 * @property string $modified
 * @property integer $user_id
 */
 //Yii::import('application.modules.user.models.User');
class Forum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Forum the static model class
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
		return 'forum_forums';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description', 'required'),
			array('forum_id, access_level_id, status, orderNo, topic_count, post_count, accessRead, accessPost, accessPoll, accessReply, settingPostCount, settingAutoLock, lastTopic_id, lastPost_id, lastUser_id, user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('slug', 'length', 'max'=>115),
			array('description', 'length', 'max'=>255),
			array('modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'update'),
        	array('created,modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'insert'),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, forum_id, access_level_id, title, slug, description, status, orderNo, topic_count, post_count, accessRead, accessPost, accessPoll, accessReply, settingPostCount, settingAutoLock, lastTopic_id, lastPost_id, lastUser_id, created, modified, user_id', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Forum', 'forum_id'),
			'children' => array(self::HAS_MANY, 'Forum', 'forum_id'),
			'subscription'=>array(self::HAS_MANY,'Subcription','forum_id'),
			'lastPost'=>array(self::BELONGS_TO,'Post','lastPost_id'),
			'lastTopic'=>array(self::BELONGS_TO,'Topic','lastTopic_id'),
			'lastUser'=>array(self::BELONGS_TO,'YumUser','user_id'),
			'topic'=>array(self::HAS_MANY,'Topic','forum_id'),
			'post'=>array(self::HAS_MANY,'Post','forum_id'),
			'author'=>array(self::BELONGS_TO,'YumUser','user_id'),
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
			'access_level_id' => 'Access Level',
			'title' => 'Title',
			'slug' => 'Slug',
			'description' => 'Description',
			'status' => 'Status',
			'orderNo' => 'Order No',
			'topic_count' => 'Topic Count',
			'post_count' => 'Post Count',
			'accessRead' => 'Access Read',
			'accessPost' => 'Access Post',
			'accessPoll' => 'Access Poll',
			'accessReply' => 'Access Reply',
			'settingPostCount' => 'Setting Post Count',
			'settingAutoLock' => 'Setting Auto Lock',
			'lastTopic_id' => 'Last Topic',
			'lastPost_id' => 'Last Post',
			'lastUser_id' => 'Last User',
			'created' => 'Created',
			'modified' => 'Modified',
			'user_id' => 'User',
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
		$criteria->compare('access_level_id',$this->access_level_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('orderNo',$this->orderNo);
		$criteria->compare('topic_count',$this->topic_count);
		$criteria->compare('post_count',$this->post_count);
		$criteria->compare('accessRead',$this->accessRead);
		$criteria->compare('accessPost',$this->accessPost);
		$criteria->compare('accessPoll',$this->accessPoll);
		$criteria->compare('accessReply',$this->accessReply);
		$criteria->compare('settingPostCount',$this->settingPostCount);
		$criteria->compare('settingAutoLock',$this->settingAutoLock);
		$criteria->compare('lastTopic_id',$this->lastTopic_id);
		$criteria->compare('lastPost_id',$this->lastPost_id);
		$criteria->compare('lastUser_id',$this->lastUser_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->with=array('author');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
	
	public function getOptions(){
		$criteria = new CDbCriteria;
		$criteria->select=array('id','title');
		$criteria->condition='parent.forum_id=:forum_id AND parent.status=:status';
		$criteria->alias='parent';
		$criteria->params=array(':forum_id'=>0,':status'=>'1');
		$criteria->together=true;
		$criteria->with=array('children'=>array('id','title'));
		$parent = $this->findAll($criteria);
		$options=array();
		foreach ($parent as $key => $value) {
			if(isset($value->children)){
				foreach ( $value->children as $k => $child) {
				$options[$value->title][$child->id]=$child->title;
				}
			}
		}
		
		return $options;
	}
	/**
	 * Get the list of forums for the board index.
	 *
	 * @access public
	 * @return array
	 */
	public function getSubforums($id){
		$criteria = new CDbCriteria;
		$criteria->condition='parent.forum_id=:forum_id AND parent.status=:status';
		$criteria->order='parent.orderNo ASC';
		$criteria->alias = 'parent';
		$criteria->together=true;
		$criteria->with=array(
								'lastTopic'=>array('select'=>'id,title,slug, created,modified','limit'=>1),
								'lastPost'=>array('select'=>'id,content, created, modified','limit'=>1),
								'lastUser'=>array('select'=>'id, username','limit'=>1)
								);
		$criteria->select=array('id','title','slug','description','topic_count','post_count');
		$criteria->params=array(':forum_id'=>$id,':status'=>'1');
		return new CActiveDataProvider($this,array('criteria'=>$criteria));
		
	}
	public function getIndex() {
		/*$access = $this->access();
		$accessLevels = $this->accessLevels();*/
		$crit = new CDbCriteria;
		$crit->condition='parent.forum_id=:forum_id AND parent.status=:status';
		$crit->with=array('children'=>array(
							'select'=>array('id','title','slug','topic_count','post_count','description'),
							'with'=>array(
										'lastTopic'=>array('select'=>'id,title,slug, created,modified','limit'=>1),
										'lastPost'=>array('select'=>'id,content, created, modified','limit'=>1),
										'lastUser'=>array('select'=>'id, username','limit'=>1)
										)
								)
						);
		$crit->order='parent.orderNo ASC';
		$crit->alias = 'parent';
		$crit->together=true;
		$crit->params=array(':forum_id'=>0,':status'=>'1');
		$crit->select='id,title,slug';
		return new CActiveDataProvider($this,array('criteria'=>$crit));
	}
	
	protected function beforeSave(){
		if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->topic_count=0;
				$this->post_count=0;
			}
			
			return true;
		}
		else
			return false;
	}
}