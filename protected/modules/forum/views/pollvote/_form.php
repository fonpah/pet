<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pollvote-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'poll_id'); ?>
		<?php echo $form->textField($model,'poll_id'); ?>
		<?php echo $form->error($model,'poll_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'poll_option_id'); ?>
		<?php echo $form->textField($model,'poll_option_id'); ?>
		<?php echo $form->error($model,'poll_option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->