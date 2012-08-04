<?php
/**
 * 
 */
class IndexAction extends CAction {
	
	
	public function run(){
		//$dataProvider=new CActiveDataProvider('Forum');
		$model = new Forum('getIndex');
		$this->getController()->render('index',array(
											'model'=>$model,
										));
	}
}
