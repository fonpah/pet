<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	CHtml::decode($this->getIntroText($model->content)),
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index','slug'=>$model->topic->slug)),
	array('label'=>'Create Post', 'url'=>array('create','forum_id'=>$model->forum_id,'topic_id'=>$model->topic_id)),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('forum','Are you sure you want to delete this item?'))),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h4>View Post #<?php echo $model->id; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
		 'label'=>'Forum',
		 'value'=>$model->forum->parent->title
	    ),
	    array(
		 'label'=>'SubForum',
		 'value'=>$model->forum->title
	    ),
	    array(
		 'label'=>'Topic',
		 'value'=>$model->topic->title
	    ),
	    array(
		 'label'=>'Post',
		 'value'=>$model->content,
		 'type'=>'html'
	    ),
	    array(
		 'label'=>'Author',
		 'value'=>$model->user->username
	    ),
		'created',
		'modified',
	),
)); ?>
