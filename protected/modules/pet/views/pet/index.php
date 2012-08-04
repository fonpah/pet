<?php
$this->breadcrumbs=array(
	'Pets',
);

$this->menu=array(
	array('label'=>'Create Pet', 'url'=>array('create')),
	array('label'=>'Manage Pet', 'url'=>array('admin')),
);
?>

<h1>Pets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
