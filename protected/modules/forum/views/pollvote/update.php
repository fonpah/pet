<?php
$this->breadcrumbs=array(
	'Pollvotes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pollvote', 'url'=>array('index')),
	array('label'=>'Create Pollvote', 'url'=>array('create')),
	array('label'=>'View Pollvote', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pollvote', 'url'=>array('admin')),
);
?>

<h1>Update Pollvote <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>