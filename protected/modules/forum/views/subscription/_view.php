<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('forum_id')); ?>:</b>
	<?php echo CHtml::encode($data->forum->parent->title); ?>
	<br />

	<b><?php echo CHtml::encode(Yii::t('forum', 'SubForum')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->forum->title), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode(Yii::t('forum', 'Topic')); ?>:</b>
	<?php echo CHtml::encode($data->topic->title); ?>
	<br />

	<b><?php echo CHtml::encode(Yii::t('forum', 'Owner')); ?>:</b>
	<?php echo CHtml::encode($data->owner->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>