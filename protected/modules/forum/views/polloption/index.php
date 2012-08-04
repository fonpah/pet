<?php
$this->breadcrumbs=array(
	'Polloptions',
);

$this->menu=array(
	array('label'=>'Create Polloption', 'url'=>array('create')),
	array('label'=>'Manage Polloption', 'url'=>array('admin')),
);
?>

<h1>Polloptions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
