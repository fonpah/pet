<div class="view">
	
	<div class="contentContainer">
		<table cellspacing="0" class="table forums">
			<thead>
				<tr>
					<th><?php echo Yii::t('forum', 'Topic'); ?></th>
					<th><?php echo Yii::t('forum', 'Author'); ?></th>
					<th><?php echo Yii::t('forum', 'Created'); ?></th>
					<th><?php echo Yii::t('forum', 'Posts'); ?></th>
					<th><?php echo Yii::t('forum', 'Views'); ?></th>
					<th><?php echo Yii::t('forum', 'Activity'); ?></th>
				</tr>
			</thead>
			<tbody>
					<tr>
					<td>
						<?php echo CHtml::link(CHtml::decode($this->getIntroText($data->title,35)),array('//forum/post/index','slug'=>$data->slug)) ?>
					</td>
					<td>
						<?php echo CHtml::link(CHtml::decode($data->user->username),array('//profile/profile/view', 'id'=>$data->user->id)) ?>
					</td>
					<td>
						<?php echo Yii::app()->dateFormatter->format('dd-MM-yyyy',$data->user->createtime ) ?>
					</td>
					<td class="stat">
						<?php echo  CHtml::decode($data->post_count);?>
					</td>
					<td>
						<?php echo CHtml::encode($data->view_count) ?>
					</td>
					<td class="activty">
						<?php  if(isset($data->lastPost)){ $lastDate = isset($data->lastPost->created)?$data->lastPost->created:$data->created?>
							   <?php  echo Yii::app()->dateFormatter->format('dd-MM-yyyy',$lastDate) ?>
								<?php if($data->lastUser){?>
									<?php echo Yii::t('forum', 'by');?>
									<?php echo CHtml::link(CHtml::decode($data->lastUser->username),array('//profile/profile/view', 'id'=>$data->lastUser->id));?>
								<?php } ?>							
						<?php }else{?>
							<?php echo  Yii::t('forum','No latest activity to display' );?>
						<?php }?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>