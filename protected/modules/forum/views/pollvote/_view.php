<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poll_id')); ?>:</b>
	<?php echo CHtml::encode($data->poll_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poll_option_id')); ?>:</b>
	<?php echo CHtml::encode($data->poll_option_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />


</div>