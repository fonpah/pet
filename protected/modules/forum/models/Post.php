<?php

/**
 * This is the model class for table "forum_posts".
 *
 * The followings are the available columns in table 'forum_posts':
 * @property integer $id
 * @property integer $forum_id
 * @property integer $topic_id
 * @property integer $user_id
 * @property string $userIP
 * @property string $content
 * @property string $contentHtml
 * @property string $created
 * @property string $modified
 */
class Post extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return 'forum_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userIP, content', 'required'),
			array('forum_id, topic_id, user_id', 'numerical', 'integerOnly'=>true),
			array('userIP', 'length', 'max'=>100),
			array('created, modified', 'safe'),
					array('modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'update'),
        	array('created,modified','default',
              	'value'=>new CDbExpression('NOW()'),
              	'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, forum_id, topic_id, user_id, userIP, content, created, modified', 'safe', 'on'=>'search'),
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
		 'topic'=>array(self::BELONGS_TO,'Topic','topic_id'),
		 'forum'=>array(self::BELONGS_TO,'Forum','forum_id'),
		 //'post'=>array(self::BELONGS_TO,'Forum','forum_id'),
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
			'topic_id' => 'Topic',
			'user_id' => 'User',
			'userIP' => 'User Ip',
			'content' => 'Content',
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
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('userIP',$this->userIP,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->with=array('user','forum'=>array('with'=>array('parent')),'topic');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterSave(){
		if(parent::afterSave()){
			if($this->isNewRecord){
						if(Yii::app()->hasModule('forum')){
								$forumprofile = Forumprofile::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId()));
								$c = count($this->findAll('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId())));
								$forumprofile->totalPosts=isset($c)? $c: 0;
								$forumprofile->save();
							}
						
				return true;
			}
		}
		else{
			return false;
		}
	}
}