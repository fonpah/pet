<?php
$this->breadcrumbs=array(
	Yii::t('forum', 'Forums')=>array('index'),
	Yii::t('forum', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('forum', 'List Forum'), 'url'=>array('index')),
	array('label'=>Yii::t('forum', 'Create Forum'), 'url'=>array('create'),'visible'=>(Yii::app()->user->can('forum_create')?true:false)),
	array('label'=>Yii::t('forum', 'Sort Forum'), 'url'=>array('order'),'visible'=>(Yii::app()->user->can('forum_order')?true:false)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('forum-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('forum', 'Manage Forums'); ?></h1>

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
	'id'=>'forum-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'description:html',
		'status',
		'orderNo',
		'topic_count',
		'post_count',
		array(
			'name'=>'created',
			'value'=>' $data->created'
		),
		array(
			'name'=>'modified',
			'value'=>'$data->modified'
		),
		array(
			'name'=>'user_id',
			'value'=>'$data->author->username'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
