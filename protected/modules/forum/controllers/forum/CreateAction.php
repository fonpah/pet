<?php
/**
 * 
 */
class CreateAction extends CAction {
	
	
	
	public function run(){
		$model=new Forum;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Forum']))
		{
			$model->attributes=$_POST['Forum'];
			$model->user_id = Yii::app()->user->getId();
			$model->lastUser_id=Yii::app()->user->getId();
			if($model->save())
				$this->getController()->redirect(array('view','id'=>$model->id));
		}

		$this->getController()->render('create',array(
									'model'=>$model,
									));
		
	}
}
