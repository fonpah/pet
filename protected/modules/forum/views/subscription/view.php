<?php
$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Subscription', 'url'=>array('index')),
	array('label'=>'Create Subscription', 'url'=>array('create')),
	array('label'=>'Update Subscription', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Subscription', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subscription', 'url'=>array('admin')),
);
?>

<h1>View Subscription #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	    array(
	     'label'=>'Forum',
	     'value'=>$model->forum->parent->title
		),
		array(
	     'label'=>'SubForum',
	     'value'=>$model->forum->title
		),
		array(
	     'label'=>'Tpoic',
	     'value'=>$model->topic->title
		),
		'created',
	),
)); ?>
