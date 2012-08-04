<div class="view">
	    <div class="contentContainer">
		<table cellspacing="0" class="table posts">
			<tbody>
				 <tr>
				 	<td>
				 		<?php echo Yii::app()->dateFormatter->format('dd-MM-yyyy',$data->created) ?>
				 	</td>
				 	<td>&nbsp;</td>
				 </tr>
					<tr>
					<td class="valign-top" style="width:20%;">
							<strong><?php echo CHtml::link(CHtml::decode($data->user->username),array('//profile/profile/view', 'id'=>$data->user->id));?></strong><br/>
							<?php if(isset($data->user->avatar)){
								$file=explode('/', $data->user->avatar);
							   if (Yii::app()->file->set('images/small/'.$file[1])->exists) 
										echo CHtml::image(Yii::app()->createUrl('images/small/'.$file[1]));
								elseif((Yii::app()->file->set('images/'.$file[1])->exists) ){
									$thumb = yii::app()->phpThumb->create('images/'.$file[1]);  
									$thumb->adaptiveResize(100,100); 
									$thumb->save('images/small/'.$file[1]);
									echo CHtml::image(Yii::app()->createUrl('images/small/'.$file[1]));
								}
							}
							else{
								$thumb = yii::app()->phpThumb->create('images/pet/original/'.$model->avatar);  
								$thumb = yii::app()->phpThumb->create('images/no_avatar_available.jpg');  
								$thumb->adaptiveResize(100,100); 
								$thumb->save('images/small/no_avatar_avaialable.jpg');
								echo CHtml::image(Yii::app()->createUrl('images/small/no_avatar_avaialable.jpg'));
							}
							?>
							<br/>
							<a href="#" class="text-decoration-none"><strong><?php echo Yii::t('forum', 'Total Topic :');?></strong><?php  echo $data->user->forumprofile->totalTopics; ?></a>
							<br/>
							<a href="#" class="text-decoration-none"><strong><?php echo Yii::t('forum', 'Total Post :');?></strong><?php  echo $data->user->forumprofile->totalPosts; ?></a>
					</td>
					<td class="content valign-bottom">
						<?php echo CHtml::decode($data->content);?>
						<?php echo $this->renderPartial('_intern_controls', array('data'=>$data)); ?>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
	</div>


