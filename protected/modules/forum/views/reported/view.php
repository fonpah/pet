<?php
$this->breadcrumbs=array(
	'Reporteds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reported', 'url'=>array('index')),
	array('label'=>'Create Reported', 'url'=>array('create')),
	array('label'=>'Update Reported', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reported', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reported', 'url'=>array('admin')),
);
?>

<h1>View Reported #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'itemType',
		'user_id',
		'comment',
		'created',
	),
)); ?>
