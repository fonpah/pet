<?php
/**
 * 
 */
class UpdateAction extends CAction {
	
	private $controller =null;
	private $criteria=null;	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function run($id)
	{
		$this->controller=$this->getController();
		$model=$this->controller->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->contentHtml =$_POST['Post']['content'];
			if($model->save())
				$this->controller->redirect(array('view','id'=>$model->id));
		}
		
		
		$this->criteria =new CDbCriteria;
		$this->criteria->condition='post.id=:id';
		$this->criteria->alias='post';
		$this->criteria->params=array(':id'=>$id);
		$this->criteria->with=array('forum'=>array('with'=>array('parent')),'user','topic');
		$this->criteria->together=true;
		$model =Post::model()->findByPk($id);
		$this->controller->render('update',array(
			'model'=>$model,
		));
	}

}
