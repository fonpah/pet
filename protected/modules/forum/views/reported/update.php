<?php
$this->breadcrumbs=array(
	'Reporteds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reported', 'url'=>array('index')),
	array('label'=>'Create Reported', 'url'=>array('create')),
	array('label'=>'View Reported', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Reported', 'url'=>array('admin')),
);
?>

<h1>Update Reported <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>