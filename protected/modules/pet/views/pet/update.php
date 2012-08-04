<?php
$this->breadcrumbs=array(
	'Pets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pet', 'url'=>array('index')),
	array('label'=>'Create Pet', 'url'=>array('create')),
	array('label'=>'View Pet', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pet', 'url'=>array('admin')),
);
?>

<h1>Update Pet <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>