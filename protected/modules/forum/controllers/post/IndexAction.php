<?php
/**
 * 
 */
class IndexAction extends CAction {
	
	private $controller=null;
	/**
	 * Lists all models.
	 */
	public function run()
	{
		$this->controller=$this->getController();
		if(isset($_GET['slug'])){
			$topic =$this->controller->loadTopicModelBySlug($_GET['slug']);
			$criteria = new CDbCriteria;
			$criteria->condition='topic_id=:topic_id AND forum_id =:forum_id';
			$criteria->params=array(':topic_id'=>$topic->id,':forum_id'=>$topic->forum_id);
			$criteria->with= array('user'=>array('select'=>'id,username,avatar','with'=>array('forumprofile'=>array('limit'=>1))));
			$dataProvider=new CActiveDataProvider('Post',array('criteria'=>$criteria,
																'pagination'=>array(
																		'pageSize'=>2
																		)));
		    $count = Subscription::model()->find('forum_id=:forum_id AND topic_id=:topic_id AND user_id=:user_id',
															array(':forum_id'=>$topic->forum_id,
															':user_id'=>Yii::app()->user->getId(),
															':topic_id'=>$topic->id
															)
												 		);
			if(count($dataProvider)>0){
				$topic->view_count =(int)$topic->view_count+1;
				$topic->save();
			}
			
			
			$this->controller->render('index',array('dataProvider'=>$dataProvider,'topic'=>$topic,'subscribe'=>$count==null?0:1));
		}
		else{
			throw new CHttpException(400,Yii::t('forum', 'Invalid request. Please do not repeat this request again.'));
		}
		
	}

}
