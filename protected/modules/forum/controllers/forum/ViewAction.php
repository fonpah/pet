<?php
/**
 * 
 */
class ViewAction extends CAction {
	
	private $controller = null;
	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function run($id)
	{
		$this->controller=$this->getController();
		$this->controller->render('view',array(
			'model'=>$this->controller->loadModel($id)
		));
	}
	
	
	
}
