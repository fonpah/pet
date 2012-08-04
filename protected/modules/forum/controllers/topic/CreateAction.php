<?php
/**
 * 
 */
class CreateAction extends CAction {
	private $controller= null;
	private $post =null ;
	private $topic =null;
	private $forum = null;
	 private $criteria=null;
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function run()
	{
		$this->controller= $this->getController();
		$this->topic=new Topic;
		$this->post =new Post;
		// Uncomment the following line if AJAX validation is needed
		// $this->controller->performAjaxValidation($model);

		if(isset($_POST['Topic']) && isset($_POST['Post']))
		{
			$this->topic->attributes=$_POST['Topic'];
			$this->topic->user_id =Yii::app()->user->getId();
			$this->topic->lastUser_id =Yii::app()->user->getId();
			if($this->topic->save()){
				if($this->savePost()){		
					$this->topic->firstPost_id=$this->post->id;
					$this->topic->lastPost_id =$this->post->id;
					$this->topic->post_count=1;				 
					if($this->saveForum() && $this->topic->save() && $this->savePost())
					$this->controller->redirect(array('index','slug'=>$this->forum->slug));
				}
			}
				
		}
       
	    if(!isset($_GET['forum_id'])){
	    	$this->controller->redirect(array('forum/index'));
	    }
		
		$this->topic->forum =Forum::model()->findByPk($_GET['forum_id']);
		$this->topic->firstPost=$this->post;
		$this->controller->render('create',array(
			'model'=>$this->topic,
		));
	}
	
	private function savePost(){
		$this->post->attributes=$_POST['Post'];
		$this->post->contentHtml =$_POST['Post']['content'];
	    $this->post->user_id=Yii::app()->user->getId();
	    $this->post->userIP= ip2long(Yii::app()->request->getUserHostAddress());
		$this->post->forum_id =$this->topic->forum_id;
		$this->post->topic_id= $this->topic->id;
		return $this->post->save();
	}
	private function saveForum(){
		$criteria = new CDbCriteria;
		$criteria->condition='forum.id=:id';
		$criteria->with=array('parent'=>array('condition'=>'parent.forum_id =:forum_id AND parent.status=:status','params'=>array(':forum_id'=>0,':status'=>1),'limit'=>1));
		$criteria->together=true;
		$criteria->params=array(':id'=>$this->topic->forum_id);
		$criteria->alias='forum';
		$this->forum =Forum::model()->find($criteria);
		
		$this->forum->lastTopic_id =$this->topic->id;
		if(isset($this->forum->parent))
		$this->forum->parent->lastTopic_id =$this->topic->id;
		
		$this->forum->lastPost_id =$this->post->id;
		if(isset($this->forum->parent))
		$this->forum->parent->lastPost_id =$this->post->id;
		
		
		$this->forum->topic_count=(int)$this->forum->topic_count+1;
		if(isset($this->forum->parent))
		$this->forum->parent->topic_count=(int)$this->forum->topic_count+1;
		
		$this->forum->post_count=(int)$this->forum->post_count+1;
		if(isset($this->forum->parent))
		$this->forum->parent->post_count=(int)$this->forum->post_count+1;
		
		$this->forum->lastUser_id = Yii::app()->user->getId();
		if(isset($this->forum->parent))
		$this->forum->lastUser_id = Yii::app()->user->getId();
		
		
		if(isset($this->forum->parent))
		$this->forum->parent->save();
		
		return $this->forum->save();
		
	}
}
