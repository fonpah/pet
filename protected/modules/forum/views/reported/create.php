<?php
$this->breadcrumbs=array(
	'Reporteds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reported', 'url'=>array('index')),
	array('label'=>'Manage Reported', 'url'=>array('admin')),
);
?>

<h1>Create Reported</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>