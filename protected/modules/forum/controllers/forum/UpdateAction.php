<?php
/**
 * 
 */
class UpdateAction extends CAction {
	
	private $controller;
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	
	public function run($id){
		$this->controller=$this->getController();
		$model=$this->controller->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Forum']))
		{
			$model->attributes=$_POST['Forum'];
			$model->user_id = Yii::app()->user->getId();
			if($model->save())
				$this->controller->controller->redirect(array('view','id'=>$model->id));
		}

		$this->controller->render('update',array(
			'model'=>$model,
		));
	}
	
}
