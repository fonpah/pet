<?php
$this->breadcrumbs=array(
	'Polloptions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Polloption', 'url'=>array('index')),
	array('label'=>'Create Polloption', 'url'=>array('create')),
	array('label'=>'Update Polloption', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Polloption', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Polloption', 'url'=>array('admin')),
);
?>

<h1>View Polloption #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'poll_id',
		'option',
		'vote_count',
	),
)); ?>
