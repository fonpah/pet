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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Topic']))
		{
			$model->attributes=$_POST['Topic'];
			$model->user_id =Yii::app()->user->getId();
			if($model->save())
				$this->controller->redirect(array('view','id'=>$model->id));
		}

		$this->criteria =new CDbCriteria;
		$this->criteria->condition='topic.id=:id';
		$this->criteria->alias='topic';
		$this->criteria->params=array(':id'=>$id);
		$this->criteria->with=array('forum','firstPost');
		$this->criteria->together=true;
		$model=Topic::model()->find($this->criteria);
		$this->controller->render('update',array(
			'model'=>$model
		));
	}

	
}
