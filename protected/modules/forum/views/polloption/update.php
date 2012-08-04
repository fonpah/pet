<?php
$this->breadcrumbs=array(
	'Polloptions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Polloption', 'url'=>array('index')),
	array('label'=>'Create Polloption', 'url'=>array('create')),
	array('label'=>'View Polloption', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Polloption', 'url'=>array('admin')),
);
?>

<h1>Update Polloption <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>