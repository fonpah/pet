<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_of_birth')); ?>:</b>
	<?php echo CHtml::encode($data->date_of_birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('story')); ?>:</b>
	<?php echo CHtml::encode($data->story); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
	<?php echo CHtml::encode($data->avatar); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('favorite_feed')); ?>:</b>
	<?php echo CHtml::encode($data->favorite_feed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favorite_toy')); ?>:</b>
	<?php echo CHtml::encode($data->favorite_toy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favorite_game_art')); ?>:</b>
	<?php echo CHtml::encode($data->favorite_game_art); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('breeder')); ?>:</b>
	<?php echo CHtml::encode($data->breeder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pedigree')); ?>:</b>
	<?php echo CHtml::encode($data->pedigree); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nickname')); ?>:</b>
	<?php echo CHtml::encode($data->nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('race_id')); ?>:</b>
	<?php echo CHtml::encode($data->race_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('veterinarian')); ?>:</b>
	<?php echo CHtml::encode($data->veterinarian); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('club')); ?>:</b>
	<?php echo CHtml::encode($data->club); ?>
	<br />

	*/ ?>

</div>