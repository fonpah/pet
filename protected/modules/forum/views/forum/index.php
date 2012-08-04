<?php
$this->breadcrumbs=array(
	'Forums',
);

$this->menu=array(
	array('label'=>Yii::t('forum', 'Create Forum'), 'url'=>array('create'),'visible'=>(Yii::app()->user->can('forum_create')?true:false)),
	array('label'=>Yii::t('forum', 'Manage Forum'), 'url'=>array('admin'),'visible'=>(Yii::app()->user->can('forum_create')?true:false)),
	array('label'=>Yii::t('forum', 'Sort Forum'), 'url'=>array('order'),'visible'=>(Yii::app()->user->can('forum_create')?true:false)),
);
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->getIndex(),
	'itemView'=>'_index',
));

?>
