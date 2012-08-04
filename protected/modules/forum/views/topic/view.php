<?php
$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create','slug'=>$model->forum->slug)),
	array('label'=>'Update Topic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Topic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Create Post', 'url'=>array('post/create','slug'=>$model->slug)),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
?>
<h4>Topic # <?php echo $model->title; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		 array(
		 'label'=>'Forum',
		 'value'=>$model->forum->title
		 ),
		'post_count',
		'view_count',
		'user.username',
		'created',
		'modified'
		)
)); ?>