<?php
/**
 * 
 */
class UpdateAction extends CAction {
	public $controller=null;
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function run($id)
	{
		$this->controller=$this->getController();
		$criteria =new CDbCriteria;
		$criteria->condition="pet.id=:id";
		$criteria->params=array(':id'=>$id);
		$criteria->alias='pet';
		$criteria->with=array('owner');
		$model=$this->loadModel($criteria);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pet']))
		{
			$model->attributes=$_POST['Pet'];
			//$model->user_id =Yii::app()->user->getId();
			if($model->save())
				$this->controller->redirect(array('view','id'=>$model->id));
		}
		
		$this->controller->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param Criteria object of the model to be loaded
	 */
	public function loadModel($criteria)
	{
		$model=Pet::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
