<?php
/**
 * 
 */
class DeleteAction extends CAction {
	
     private $controller = null;
	 private $forum =null;
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function run($id)
	{
		$this->controller = $this->getController();
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			//$this->controller->loadModel($id)->delete();
			$criteria =new CDbCriteria;
			$criteria->condition='forum.id=:id';
			$criteria->with=array('topic','post','children');
			$criteria->together=true;
			$criteria->alias='forum';
			$criteria->params=array(':id'=>$id);
			$this->forum =Forum::model()->find($criteria);
			if(isset($this->forum->topic) && count($this->forum->topic)>0){
				foreach ($this->forum->topic as $key => $value) {
					$value->delete();
				}
			}
			
			if(isset($this->forum->post) && count($this->forum->post)>0){
				foreach ($this->forum->post as $key => $value) {
					$value->delete();
				}
			}
			
			
			if(isset($this->forum->children) && count($this->forum->children)>0){
				foreach ($this->forum->children as $key => $value) {
					$value->delete();
				}
			}
			
			
			
			$this->forum->delete();
			

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
}
