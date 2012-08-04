<?php
$this->breadcrumbs=array(
	'Reporteds',
);

$this->menu=array(
	array('label'=>'Create Reported', 'url'=>array('create')),
	array('label'=>'Manage Reported', 'url'=>array('admin')),
);
?>

<h1>Reporteds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
