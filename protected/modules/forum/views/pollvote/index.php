<?php
$this->breadcrumbs=array(
	'Pollvotes',
);

$this->menu=array(
	array('label'=>'Create Pollvote', 'url'=>array('create')),
	array('label'=>'Manage Pollvote', 'url'=>array('admin')),
);
?>

<h1>Pollvotes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
