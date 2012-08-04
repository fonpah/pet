<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forum_id'); ?>
		<?php echo $form->textField($model,'forum_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'access_level_id'); ?>
		<?php echo $form->textField($model,'access_level_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>115)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orderNo'); ?>
		<?php echo $form->textField($model,'orderNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'topic_count'); ?>
		<?php echo $form->textField($model,'topic_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_count'); ?>
		<?php echo $form->textField($model,'post_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accessRead'); ?>
		<?php echo $form->textField($model,'accessRead'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accessPost'); ?>
		<?php echo $form->textField($model,'accessPost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accessPoll'); ?>
		<?php echo $form->textField($model,'accessPoll'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accessReply'); ?>
		<?php echo $form->textField($model,'accessReply'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'settingPostCount'); ?>
		<?php echo $form->textField($model,'settingPostCount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'settingAutoLock'); ?>
		<?php echo $form->textField($model,'settingAutoLock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastTopic_id'); ?>
		<?php echo $form->textField($model,'lastTopic_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastPost_id'); ?>
		<?php echo $form->textField($model,'lastPost_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastUser_id'); ?>
		<?php echo $form->textField($model,'lastUser_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->