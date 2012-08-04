
<div class="view">
	    <div class="headerContainer">
	    	<?php echo CHtml::decode($data->title);?>
	    </div>
	    <div class="contentContainer">
		<table cellspacing="0" class="table forums">
			<thead>
				<tr>
					<th ><?php echo Yii::t('forum', 'Forum'); ?></th>
					<th style="width: 10%"><?php echo Yii::t('forum', 'Topics'); ?></th>
					<th style="width: 10%"><?php echo Yii::t('forum', 'Posts'); ?></th>
					<th style="width: 30%"><?php echo Yii::t('forum', 'Activity'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data->children as $key => $value) {?>
					<tr>
					<td>
						<strong>
						<?php echo CHtml::link(CHtml::decode($value->title),array('//forum/topic/index','slug'=>$value->slug)) ?>
						</strong>
						<br/>
						<?php echo CHtml::decode($value->description);?>
					</td>
					<td class="stat">
						<?php  echo CHtml::decode($value->topic_count);?>
					</td>
					<td class="stat">
						<?php echo  CHtml::decode($value->post_count);?>
					</td>
					<td class="activty">
						<?php  if(isset($value->lastTopic)){ $lastDate = isset($value->lastPost->created)?$value->lastPost->created:$value->lastTopic->created?>
								<?php echo CHtml::link(CHtml::decode($this->getIntroText($value->lastTopic->title,25)),array('//forum/post/index','slug'=>$value->lastTopic->slug));?><br/>
								<em class="timeago" title="<?php echo CHtml::decode($lastDate)?>"> <?php echo CHtml::decode($lastDate)?>
									<?php $this->widget('application.extensions.timeago.JTimeAgo');?>
								</em>
								<?php if($value->lastUser){?>
									<?php echo Yii::t('forum', 'by');?>
									<?php echo CHtml::link(CHtml::decode($value->lastUser->username),array('//profile/profile/view', 'id'=>$value->lastUser->id));?>
								<?php } ?>							
						<?php }else{?>
							<?php echo  Yii::t('forum','No latest activity to display' );?>
						<?php }?>
					</td>
				</tr>
					
				<?php }?>
			</tbody>
		</table>
		</div>
	</div>


