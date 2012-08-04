<?php
/**
 * 
 */
class CreateAction extends CAction {
	
	private $controller =null;
	private $topic =null;
	private $post = null;
	private $forum=null;
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function run()
	{
		$this->controller=$this->getController();
		$this->post=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$this->post->attributes=$_POST['Post'];
			$this->post->contentHtml =$_POST['Post']['content'];
			$this->post->user_id=Yii::app()->user->getId();
			$this->post->userIP= ip2long(Yii::app()->request->getUserHostAddress());
			if($this->post->save()){
				$this->topic = $this->controller->loadTopicModel($this->post->topic_id);
				/*if(!isset($this->topic->firstPost_id)){
					$this->topic->firstPost_id =$this->post->id;
					
				}*/
				 $this->saveForum();
				 $this->saveTopic();
				$this->controller->redirect(array('index','slug'=>$this->topic->slug));
			}
				
		}
		
		
		if( !isset($_GET['topic_id']) && !isset($_GET['forum_id'])){
				throw new CHttpException(404,Yii::t('forum','Bad Request'));
			//$this->controller->redirect(array('index'));
		}
		
		$this->post->forum =Forum::model()->findByPk($_GET['forum_id']);
		$this->post->topic =Topic::model()->find('forum_id=:forum_id AND id =:id',array(':forum_id'=>$this->post->forum->id,':id'=>$_GET['topic_id']));
		$this->controller->render('create',array(
												'model'=>$this->post,
											));
	}
	private function saveForum(){
		$criteria = new CDbCriteria;
		$criteria->condition='forum.id=:id';
		$criteria->with=array('parent'=>array('condition'=>'parent.forum_id =:forum_id AND parent.status=:status','params'=>array(':forum_id'=>0,':status'=>1),'limit'=>1));
		$criteria->together=true;
		$criteria->alias='forum';
		$criteria->params=array(':id'=>$this->post->forum_id);
		$this->forum =Forum::model()->find($criteria);
		$this->forum->lastPost_id=$this->post->id;
		$this->forum->lastUser_id= Yii::app()->user->getId();
		$this->forum->post_count=(int)$this->forum->post_count+1;
		if(isset($this->forum->parent)){
			$this->forum->parent->lastPost_id=$this->post->id;
			$this->forum->parent->lastUser_id= Yii::app()->user->getId();
			$this->forum->parent->post_count=(int)$this->forum->post_count+1;
			$this->forum->parent->save();
		} 
		
		return $this->forum->save();
	}

	private function saveTopic(){
				$this->topic->lastPost_id=$this->post->id;
				$this->topic->lastUser_id= Yii::app()->user->getId();
				$this->topic->post_count=(int)$this->topic->post_count+1;
				
				return $this->topic->save();
	}
}
