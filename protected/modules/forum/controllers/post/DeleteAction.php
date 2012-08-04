<?php
/**
 * 
 */
class DeleteAction extends CAction {
	
	private $controller= null;
	private $post=null;
	private $topic=null;
	private $forum=null;
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function run($id)
	{
		$this->controller=$this->getController();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->post=$this->controller->loadModel($id);
			$this->post->delete();
			$this->resetForum();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		throw new CHttpException(400,Yii::t('forum', 'Invalid request. Please do not repeat this request again.'));
	}
	
	private function resetForum(){
		$pc =count(Post::model()->findAll('forum_id=:forum_id AND topic_id=:topic_id',array(':topic_id'=>$this->post->topic_id,':forum_id'=>$this->post->forum_id)));
		$pct =count(Post::model()->findAll('forum_id=:forum_id',array(':forum_id'=>$this->post->forum_id)));
		//$tc=count(Topic::model()->findAll('forum_id=:forum_id ',array(':forum_id'=>$this->post->forum_id)));
		$criteria = new CDbCriteria;
		$criteria->condition='forum.id=:id';
		$criteria->with=array(
							'parent'=>array('condition'=>'parent.forum_id =:forum_id AND parent.status=:status','params'=>array(':forum_id'=>0,':status'=>1),'limit'=>1),
							'topic'=>array('condition'=>'topic.id=:topic_id','params'=>array(':topic_id'=>$this->post->topic_id),'limit'=>1));
		$criteria->together=true;
		$criteria->params=array(':id'=>$this->post->forum_id);
		$criteria->alias='forum';
		$this->forum =Forum::model()->find($criteria);
		$this->forum->lastPost_id=$this->forum->lastPost_id==$this->post->id?null :$this->forum->lastPost_id;
		$this->forum->lastUser_id= Yii::app()->user->getId();
		$this->forum->post_count=$pct;
		$this->forum->save();
		if(isset($this->forum->parent)){
			$this->forum->parent->lastPost_id=$this->forum->parent->lastPost_id==$this->post->id?null :$this->forum->parent->lastPost_id;;
			$this->forum->parent->lastUser_id= Yii::app()->user->getId();
			$this->forum->parent->post_count=$pct;
			$this->forum->parent->save();
		} 
		
		if(isset($this->forum->topic)){
			foreach ($this->forum->topic as $key => $value) {
					$value->post_count=$pc;
					$value->lastPost_id=$value->lastPost_id==$this->post->id?null :$value->lastPost_id;
					$value->firstPost_id=$value->firstPost_id==$this->post->id?null :$value->firstPost_id;
					$value->save();
			}
		}
	}
}
