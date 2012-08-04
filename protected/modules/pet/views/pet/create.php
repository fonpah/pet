<?php
$this->breadcrumbs=array(
	'Pets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pet', 'url'=>array('index')),
	array('label'=>'Manage Pet', 'url'=>array('admin')),
);
?>

<h1>Create Pet</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>