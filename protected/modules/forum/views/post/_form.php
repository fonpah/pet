<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'forum_id'); ?>
		<?php echo $form->textField($model->forum,'title',array('size'=>60,'maxlength'=>100,'disabled'=>'disabled')); ?>
		<?php echo $form->hiddenField($model,'forum_id',array('value'=>$model->forum->id,)); ?>
		<?php echo $form->error($model,'forum_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'topic_id'); ?>
		<?php echo $form->textField($model->topic,'title',array('size'=>60,'maxlength'=>100,'disabled'=>'disabled')); ?>
		<?php echo $form->hiddenField($model,'topic_id',array('value'=>$model->topic->id)); ?>
		<?php //echo $form->dropDownList($model,'topic_id',CHtml::listData($topic->findAll('forum_id=:forum_id',array(':forum_id'=>$forum->id)), 'id', 'title')); ?>
		<?php echo $form->error($model,'topic_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce', array('name'=>'Post[content]','id'=>'Post_content','value'=>$model->content,'editorTemplate'=>'full')); ?>
		<?php //echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->