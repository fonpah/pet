<?php
/**
 * 
 */
class ViewAction extends CAction {
 private $controller=null;
 private $criteria=null;
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function run($id)
	{
		$this->controller= $this->getController();
		$this->criteria =new CDbCriteria;
		$this->criteria->condition='topic.id=:id';
		$this->criteria->alias='topic';
		$this->criteria->params=array(':id'=>$id);
		$this->criteria->with=array('forum'=>array('with'=>array('parent')),'user');
		$this->criteria->together=true;
		$model=Topic::model()->find($this->criteria);
		$this->controller->render('view',array(
			'model' =>$model
		));
	}

}
