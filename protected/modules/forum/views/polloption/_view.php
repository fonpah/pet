<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poll_id')); ?>:</b>
	<?php echo CHtml::encode($data->poll_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option')); ?>:</b>
	<?php echo CHtml::encode($data->option); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_count')); ?>:</b>
	<?php echo CHtml::encode($data->vote_count); ?>
	<br />


</div>