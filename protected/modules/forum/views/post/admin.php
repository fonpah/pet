<?php
$this->breadcrumbs=array(
	//'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('post-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('forum', 'Manage Posts'); ?></h1>

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
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		  'name'=>'forum_id',
		  'value'=>'$data->forum->parent->title',
		  'header'=>'Forum',
		),
		array(
		  'name'=>'forum_id',
		  'value'=>'$data->forum->title',
		  'header'=>'SubForum',
		),
		array(
		  'name'=>'topic_id',
		  'value'=>'$data->topic->title',
		  'header'=>'Topic',
		),
		array(
		  'name'=>'user_id',
		  'value'=>'$data->user->username',
		  'header'=>'Author',
		),
		array(
		  'name'=>'content',
		  'value'=>'$data->content',
		  'header'=>'Post',
		  'type'=>'html'
		),
		/*'forum_id',
		'topic_id',
		'user_id',
		'userIP',
		'content',
		
		'contentHtml',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
