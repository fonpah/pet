<?php
/**
 * 
 */
class AdminAction extends CAction {
	
private $controller=null;	
	/**
	 * Manages all models.
	 */
	public function run()
	{
		$this->controller=$this->getController();
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		$this->controller->layout='//layouts/column1';
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

		$this->controller->render('admin',array(
			'model'=>$model,
		));
	}

}
