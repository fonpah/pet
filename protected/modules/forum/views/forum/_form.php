<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forum-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'orderNo'); ?>
		<?php echo $form->textField($model,'orderNo'); ?>
		<?php echo $form->error($model,'orderNo'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'forum_id'); ?>
		<?php 		  
		 	echo $form->dropDownList($model, 'forum_id',CHtml::listData($model::model()->findAll('forum_id=:forum_id AND status=:status',array(':forum_id'=>0,':status'=>1)), 'id','title'),array('prompt'=>'')) ;
		?>
		<?php echo $form->error($model,'forum_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropdownList($model,'status',array('1'=>'Open','0'=>'Closed')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce', array('name'=>'Forum[description]','id'=>'Forum_description','value'=>$model->description,'editorTemplate'=>'full')); ?>
		<?php //echo $form->textarea($model,'description',array('size'=>60,'maxlength'=>255,'cols'=>'45','rows'=>5)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->