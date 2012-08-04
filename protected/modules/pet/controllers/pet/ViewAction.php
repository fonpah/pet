<?php
/**
 * 
 */
class ViewAction extends CAction {
	private $controller=null;
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
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
		$this->controller->render('view',array(
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
