<ul class="intern_controls float-right">
	<li>
		<?php echo CHtml::link(Yii::t('forum','Edit'),array('//forum/post/update','id'=>$data->id),array('class'=>'valign-bottom')); ?>
	</li>
	<li>
		<?php echo CHtml::link(Yii::t('forum','Delete'),array('//forum/post/delete','id'=>$data->id)); ?>
	</li>
	<li>
		<?php echo CHtml::link(Yii::t('forum','Quote'),array('//forum/post/delete','id'=>$data->id)); ?>
	</li>
	<li>
		<?php echo CHtml::link(Yii::t('forum','Top'),array('#')); ?>
	</li>
</ul>