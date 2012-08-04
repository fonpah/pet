<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pet-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_of_birth'); ?>
		<?php //echo $form->textField($model,'date_of_birth'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
		 'name'=>'Pet[date_of_birth]',
		 'id'=>'Pet_date_of_birth',
		 'value'=>($model->isNewRecord?null:$model->date_of_birth),
		 	'model'=>$model,
		 	'options'=>array(
				'showAnim'=>'fold',
				'changeMonth'=>true,
				'changeYear'=>true,
				'dateFormat'=>'yy-mm-dd'
				
			),
			'htmlOptions'=>array(
				
			)
		)); ?>
		<?php echo $form->error($model,'date_of_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropdownList($model,'gender',array('M'=>'Male','F'=>'Female'),array('prompt'=>'Select Gender','size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'story'); ?>
		<?php echo $form->textField($model,'story',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'story'); ?>
	</div>
	<?php } ?>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>
	<?php } ?>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'favorite_feed'); ?>
		<?php echo $form->textField($model,'favorite_feed',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'favorite_feed'); ?>
	</div>
	<?php } ?>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'favorite_toy'); ?>
		<?php echo $form->textField($model,'favorite_toy',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'favorite_toy'); ?>
	</div>
	<?php } ?>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'favorite_game_art'); ?>
		<?php echo $form->textField($model,'favorite_game_art',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'favorite_game_art'); ?>
	</div>
	<?php } ?>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'breeder'); ?>
		<?php echo $form->textField($model,'breeder',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'breeder'); ?>
	</div>
	<?php } ?>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'pedigree'); ?>
		<?php echo $form->textField($model,'pedigree',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'pedigree'); ?>
	</div>
	<?php } ?>
	<div class="row">
		<?php echo $form->labelEx($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nickname'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'veterinarian'); ?>
		<?php echo $form->textField($model,'veterinarian',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'veterinarian'); ?>
	</div>
	<?php if(!$model->isNewRecord){?>
	<div class="row">
		<?php echo $form->labelEx($model,'club'); ?>
		<?php echo $form->textField($model,'club',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'club'); ?>
	</div>
	<?php } ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->