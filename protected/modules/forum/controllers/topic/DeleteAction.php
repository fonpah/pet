<?php
/**
 * 
 */
class DeleteAction extends CAction {
	private $controller =null;
	private $topic=null;
	private $post = null;
	private $forum=null;
	private $post_count =null;
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function run($id)
	{
		$this->controller= $this->getController();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->topic=$this->controller->loadModel($id);
			$this->deletePost();
			$this->topic->delete();
			$this->resetForum();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('forum', 'Invalid request. Please do not repeat this request again.'));
	}
	
	private function resetForum(){
		$pc =count(Post::model()->findAll('forum_id=:forum_id',array(':forum_id'=>$this->topic->forum_id)));
		$tc=count(Topic::model()->findAll('forum_id=:forum_id ',array(':forum_id'=>$this->topic->forum_id)));
		$criteria = new CDbCriteria;
		$criteria->condition='forum.id=:id';
		$criteria->with=array('parent'=>array('condition'=>'parent.forum_id =:forum_id AND parent.status=:status','params'=>array(':forum_id'=>0,':status'=>1),'limit'=>1));
		$criteria->together=true;
		$criteria->alias='forum';
		$criteria->params=array(':id'=>$this->topic->forum_id);
		$this->forum =Forum::model()->find($criteria);
		$this->forum->lastPost_id='';
		$this->forum->lastUser_id= Yii::app()->user->getId();
		$this->forum->post_count=$pc;
		$this->forum->topic_count=$tc;
		$this->forum->lastTopic_id='';
		$this->forum->save();
		if(isset($this->forum->parent)){
			$this->forum->parent->lastPost_id='';
			$this->forum->parent->lastUser_id= Yii::app()->user->getId();
			$this->forum->parent->post_count=$pc;
			$this->forum->parent->lastTopic_id='';
			$this->forum->parent->topic_count=$tc;
			$this->forum->parent->save();
		} 
	}
	private function deletePost(){
		$criteria =new CDbCriteria;
		$criteria->condition='topic_id=:topic_id';
		$criteria->params=array(':topic_id'=>$this->topic->id);
		$this->post_count=Post::model()->deleteAll($criteria);
		if($this->post_count>0){
			$this->resetForum();
			
		}
	}

}
