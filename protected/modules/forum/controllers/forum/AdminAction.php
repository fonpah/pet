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
		$this->controller= $this->getController();
		$model=new Forum('search');
		$model->unsetAttributes();  // clear any default values
		$this->controller->layout='//layouts/column1';
		if(isset($_GET['Forum']))
			$model->attributes=$_GET['Forum'];

		$this->controller->render('admin',array(
			'model'=>$model,
		));
	}
   }
   