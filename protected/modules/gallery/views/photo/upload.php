<?php
echo CHtml::beginForm('','post',array('enctype'=>'multipart/form-data'))?>
<div class="row">
		<strong>Your Pet(s)</strong>
		<br/>
		<?php echo CHtml::activeDropDownList($model, 'pet_id', CHtml::listData(Pet::model()->findAll('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId())), 'id', 'name')); ?>
		<?php echo CHtml::error($model,'pet_id'); ?>
</div>
<div class="row">
	<?php echo CHtml::error($model, 'image'); ?>
	<?php echo CHtml::activeFileField($model, 'image')?>
</div>
<?php echo CHtml::resetButton('Clear') ?> <?php echo CHtml::submitButton('Upload');?>
<?php echo CHtml::endForm()?>
	<?php if(isset($photos) && count($photos)>0){?>


					<?php foreach($photos as $k=>$pic){?>
					<div class="view">
									<?php
									   $dirsmall=Yii::app()->file->set('images/pet/'.$pic->pet_id.'/small');
									   $filesmall=Yii::app()->file->set('images/pet/'.$pic->pet_id.'/small/'.$pic->filename);
									   $dir=Yii::app()->file->set('images/pet/'.$pic->pet_id);
									   $file=Yii::app()->file->set('images/pet/'.$pic->pet_id.'/'.$pic->filename);
									   if ($filesmall->exists) {
									   	echo CHtml::image(Yii::app()->createUrl('images/pet/'.$pic->pet_id.'/small/'.$pic->filename));?>
									   <strong><?php echo CHtml::encode($pic->filename); ?></strong>
								<?php  }
									    elseif(!$dirsmall->exists && ! $dirsmall->isdir){
											$dirsmall->createdir();	
											$thumb = yii::app()->phpThumb->create('images/pet/'.$pic->pet_id.'/'.$pic->filename);  
											$thumb->adaptiveResize(100,100); 
											$thumb->save('images/pet/'.$pic->pet_id.'/small/'.$pic->filename);
											echo CHtml::image(Yii::app()->createUrl('images/pet/'.$pic->pet_id.'/small/'.$pic->filename));?>
											<strong><?php echo CHtml::encode($pic->filename); ?></strong>
								<?php	}elseif(!$filesmall->exists){
											$thumb = yii::app()->phpThumb->create('images/pet/'.$pic->pet_id.'/'.$pic->filename);  
											$thumb->adaptiveResize(100,100); 
											$thumb->save('images/pet/'.$pic->pet_id.'/small/'.$pic->filename);
											echo CHtml::image(Yii::app()->createUrl('images/pet/'.$pic->pet_id.'/small/'.$pic->filename));?>
											<strong><?php echo CHtml::encode($pic->filename); ?></strong>
								<?php	}
									?>
									
					</div>
				   <?php } ?>
	<?php } else {
		echo 'No pictures to Display!';
	}?>
