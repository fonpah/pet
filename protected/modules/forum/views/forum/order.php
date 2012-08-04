
<?php 
$this->breadcrumbs=array(
	Yii::t('forum', 'Forums')=>array('index'),
	Yii::t('forum', 'Sort Forums'),
);
$this->menu=array(
	array('label'=>Yii::t('forum', 'List Forum'), 'url'=>array('index')),
	array('label'=>Yii::t('forum', 'Create Forum'), 'url'=>array('create'),'visible'=>(Yii::app()->user->can('forum_create')?true:false)),
	array('label'=>Yii::t('forum', 'Sort Forum'), 'url'=>array('order'),'visible'=>(Yii::app()->user->can('forum_order')?true:false)),
);
echo $this->renderPartial('_order', array('model'=>$model)); 
?>