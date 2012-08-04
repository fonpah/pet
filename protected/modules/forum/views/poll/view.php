<?php
$this->breadcrumbs=array(
	'Polls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Poll', 'url'=>array('index')),
	array('label'=>'Create Poll', 'url'=>array('create')),
	array('label'=>'Update Poll', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Poll', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Poll', 'url'=>array('admin')),
);
?>

<h1>View Poll #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'topic_id',
		'created',
		'modified',
		'expires',
	),
)); ?>
