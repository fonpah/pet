<?php
$this->breadcrumbs=array(
	'Pollvotes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pollvote', 'url'=>array('index')),
	array('label'=>'Manage Pollvote', 'url'=>array('admin')),
);
?>

<h1>Create Pollvote</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>