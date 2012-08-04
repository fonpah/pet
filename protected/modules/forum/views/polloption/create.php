<?php
$this->breadcrumbs=array(
	'Polloptions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Polloption', 'url'=>array('index')),
	array('label'=>'Manage Polloption', 'url'=>array('admin')),
);
?>

<h1>Create Polloption</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>