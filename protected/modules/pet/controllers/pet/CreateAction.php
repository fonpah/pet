<?php
/**
 * 
 */
class CreateAction extends CAction {
	
	private $controller=null;
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function run()
	{
		$model=new Pet;
		$this->controller=$this->getController();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pet']))
		{
			$model->attributes=$_POST['Pet'];
			$model->status=1;
			$model->user_id =Yii::app()->user->getId();
			if($model->save())
				$this->controller->redirect(array('view','id'=>$model->id));
		}

		$this->controller->render('create',array(
			'model'=>$model,
		));
	}
}
