<?php
$this->breadcrumbs=array(
	'Pollvotes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pollvote', 'url'=>array('index')),
	array('label'=>'Create Pollvote', 'url'=>array('create')),
	array('label'=>'Update Pollvote', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pollvote', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pollvote', 'url'=>array('admin')),
);
?>

<h1>View Pollvote #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'poll_id',
		'poll_option_id',
		'user_id',
	),
)); ?>
