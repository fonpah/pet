<?php
$this->breadcrumbs=array(
	$forumModel->title=>array('label'=>Yii::t('forum','Forum'), 'url'=>array('forum/index')),
	'Topics',
);

$this->menu=array(
	array('label'=>Yii::t('forum','Forum'), 'url'=>array('forum/index')),
	array('label'=>Yii::t('forum', 'Create Topic'), 'url'=>array('create'),'visible'=>(Yii::app()->user->can('topic_create')?true:false)),
	array('label'=>Yii::t('forum','Manage Topic'), 'url'=>array('admin','visible'=>( Yii::app()->user->can('topic_admin')?true:false))),
);
?>


<h1><?php echo $forumModel->title; ?></h1>
<h4>
	<?php echo $forumModel->description;?>
</h4>
<?php $dataProvider= $model->getTopicsByForum($forumModel->id);
if($dataProvider->getTotalItemCount()>0){?>
<div class="float-right display-block top-control">
	<?php echo $this->renderPartial('_controls', array('model'=>$model,'class'=>'control_top','forum'=>$forumModel)); ?>
</div>
<div class="clear"></div>

		<?php  $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_index',
				'emptyText'=> Yii::t('forum', 'No Topics to Display')
			)); ?>
<div class="clear"></div>
<br/>
<div class="float-right display-block bottom-control">
	<?php echo $this->renderPartial('_controls', array('model'=>$model,'class'=>'control_bottom','forum'=>$forumModel)); ?>
</div>

<?php }else{?>
				<div class="float-right display-block top-control">
					<?php echo $this->renderPartial('_controls', array('model'=>$model,'class'=>'control_top','forum'=>$forumModel)); ?>
				</div>
				<br/>
				<br/>
				<br/>
				<div class="display-block view">
		 		<?php echo Yii::t('forum', 'No Topics to Display!');?>
		 		</div>
<?php } ?>