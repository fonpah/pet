<?php
$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Subscription', 'url'=>array('index')),
	array('label'=>'Create Subscription', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subscription-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Subscriptions</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subscription-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		 'name'=>'forum_id',
		 'value'=>'$data->forum->parent->title',
		 'header'=>'Forum'
		),
		array(
		 'name'=>'forum_id',
		 'value'=>'$data->forum->title',
		 'header'=>'SubForum'
		),
		array(
		 'name'=>'topic_id',
		 'value'=>'$data->topic->title',
		 'header'=>'Topic'
		),
		array(
		 'name'=>'user_id',
		 'value'=>'$data->owner->username',
		 'header'=>'Owner'
		),
		'created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
