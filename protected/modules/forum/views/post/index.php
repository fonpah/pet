<?php
$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('forum','Topic :'); ?> <?php echo $topic->title;?></h3>
<?php      if($dataProvider->getTotalItemCount()>0){?>
<div class="float-right display-block">
	<?php echo $this->renderPartial('_controls', array('class'=>'control_top','topic'=>$topic,'subscribe'=>$subscribe)); ?>
</div>
<div class="clear"></div>
<?php

     $this->widget('zii.widgets.CListView', array(
								'dataProvider'=>$dataProvider,
								'itemView'=>'_view',
							));?>
<div class="clear"></div>
<br/>
<div class="float-right display-block">
	<?php echo $this->renderPartial('_controls', array('class'=>'control_bottom','topic'=>$topic,'subscribe'=>$subscribe)); ?>
</div>
 <?php }else{?>
		 	<div class="display-block">
		 		<?php echo Yii::t('forum', 'No Posts to Display!');?>
		 	</div>
<?php } ?>