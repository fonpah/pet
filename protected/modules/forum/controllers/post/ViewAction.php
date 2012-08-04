<?php
/**
 * 
 */
class ViewAction extends CAction {
	private $controller =null;
	private $criteria =null;
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function run($id)
	{
		$this->controller=$this->getController();
		$this->criteria =new CDbCriteria;
		$this->criteria->condition='post.id=:id';
		$this->criteria->alias='post';
		$this->criteria->params=array(':id'=>$id);
		$this->criteria->with=array('forum'=>array('with'=>array('parent')),'user','topic');
		$this->criteria->together=true;
		$this->controller->render('view',array(
			'model'=>Post::model()->findByPk($id),
		));
	}
}
