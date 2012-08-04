<?php 
/**
 * 
 */
class OrderAction extends CAction {
	
	function run() {
		
		if(isset($_POST['Forum']))
		{
			foreach ($_POST['Forum'] as $key => $value) {
				$model = $this->getController()->loadModel($value['id']);
				if($model!==null)
				$model->saveCounters(array('orderNo'=>$value['orderNo']));
			}
			
			$this->getController()->redirect(array('index'));
		}

		$this->getController()->render('order',array(
			'model'=>$this->getForum(),
		));
	}
	
	private function getForum(){
		$crit = new CDbCriteria;
		$crit->condition='parent.forum_id=:forum_id AND parent.status=:status';
		$crit->with=array('children'=>array(
							'select'=>array('id','title','orderNo')
								)
						);
		$crit->order='parent.orderNo ASC';
		$crit->alias = 'parent';
		$crit->together=true;
		$crit->params=array(':forum_id'=>0,':status'=>'1');
		$crit->select='id,title,orderNo';
		return $model = Forum::model()->findAll($crit);
	}
}
