<?php
$this->breadcrumbs=array(
	'Forums'=>array('forum/index'),
	'Topic Manage',
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('topic-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('forum', 'Manage Topics'); ?></h1>

<p>
<?php echo Yii::t('forum', 'You may optionally enter a comparison operator'); ?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
<?php echo Yii::t('forum', 'or'); ?>  <b>=</b>)<?php echo Yii::t('forum', 'at the beginning of each of your search values to specify how the comparison should be done.'); ?> 
</p>

<?php echo CHtml::link(Yii::t('forum', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'topic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		array(
		 'name'=>'forum_id',
		 'value'=>'$data->forum->title'
		),
		array(
		 'name'=>'user_id',
		 'value'=>'$data->user->username'
		),
		array(
		 'name'=>'firstPost_id',
		 'value'=>'$data->firstPost->content',
		 'type'=>'html'
		),
		'status',
		/*
		'type',
		'post_count',
		'view_count',
		'firstPost_id',
		'lastPost_id',
		'lastUser_id',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
