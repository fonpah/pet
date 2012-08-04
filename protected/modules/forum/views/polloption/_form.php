<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'polloption-form',
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
		<?php echo $form->labelEx($model,'option'); ?>
		<?php echo $form->textField($model,'option',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'option'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_count'); ?>
		<?php echo $form->textField($model,'vote_count'); ?>
		<?php echo $form->error($model,'vote_count'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->