<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forum-order',
	'enableAjaxValidation'=>false,
)); ?>
 <?php foreach ($model as $key => $forum) {?>
     <div class="headerContainer">
	    <?php echo $form->textField($forum,"[$key]orderNo",array('size'=>2)) ?>	<?php echo CHtml::decode($forum->title);?>
	    <?php echo $form->hiddenField($forum,"[$key]id") ?>	
	    </div>
	    <div class="contentContainer">
		<table cellspacing="0" class="table forums">
			<thead>
				<tr>
					<th ><?php echo Yii::t('forum', 'Forum'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($forum->children as $k=> $child) {?>
					<tr>
					<td>
						<?php echo $form->textField($child,"[$k]orderNo", array('size'=>2)) ?>	<?php echo CHtml::decode($child->title);?>
						<?php echo $form->hiddenField($child,"[$k]id") ?>	
					</td>
				</tr>
					
				<?php }?>
			</tbody>
		</table>
		</div>
<?php } ?>
<div class="row buttons">
		<?php echo CHtml::submitButton( 'Save'); ?>
</div>
<?php $this->endWidget(); ?>
</div>