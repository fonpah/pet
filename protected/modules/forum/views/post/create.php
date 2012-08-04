<?php
$this->breadcrumbs=array(
	'Posts'=>array('index','slug'=>$model->topic->slug),
	'Create',
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index','slug'=>$model->topic->slug)),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>Create Post</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>