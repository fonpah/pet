<?php
$this->breadcrumbs=array(
	'Forums'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('forum', 'List Forum'), 'url'=>array('index')),
	array('label'=>Yii::t('forum', 'Create Forum'), 'url'=>array('create','visible'=>( Yii::app()->user->can('forum_create')?false:true))),
	array('label'=>Yii::t('forum', 'Update Forum'), 'url'=>array('update', 'id'=>$model->id,'visible'=>( Yii::app()->user->can('forum_update')?false:true))),
	array('label'=>Yii::t('forum', 'Delete Forum'), 'url'=>'#', 'visible'=>( Yii::app()->user->can('forum_delete')?false:true),'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('forum', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('forum','Create Topic'), 'url'=>array('topic/create','slug'=>$model->slug),'visible'=>($model->id!=0 && Yii::app()->user->can('topic_create')?true:false)),
	array('label'=>Yii::t('forum','Manage Forum'), 'url'=>array('admin','visible'=>( Yii::app()->user->can('forum_admin')?true:false))),
);
?>

<h1>View Forum #<?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'description:html',
		'created',
		'modified'
		)
)); ?>
