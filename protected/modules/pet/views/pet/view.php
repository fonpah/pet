<?php
$this->breadcrumbs=array(
	'Pets'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Pet', 'url'=>array('index')),
	array('label'=>'Create Pet', 'url'=>array('create')),
	array('label'=>'Update Pet', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pet', 'url'=>array('admin')),
);
?>
<table>
	<tbody>
		<tr>
			<td class="pet-profile-image">
				 <?php 
		               if(isset($model->avatar) && !empty($model->avatar) && $model->avatar!=''){
							   if (Yii::app()->file->set('images/pet/large/'.$model->avatar)->exists) 
										echo CHtml::image(Yii::app()->createUrl('images/pet/large/'.$model->avatar));
								elseif((Yii::app()->file->set('images/pet/original/'.$model->avatar)->exists) ){
									$thumb = yii::app()->phpThumb->create('images/pet/original/'.$model->avatar);  
									$thumb->adaptiveResize(250,300); 
									$thumb->save('images/pet/large/'.$model->avatar);
									echo CHtml::image(Yii::app()->createUrl('images/pet/large/'.$model->avatar));
								}
							}
							else{
								if (!Yii::app()->file->set('images/pet/original/no_pet_avatar.png')->exists){
									$thumb = yii::app()->phpThumb->create('images/pet/original/no_pet_avatar.png');  
									$thumb->adaptiveResize(250,300); 
									$thumb->save('images/pet/large/no_pet_avatar.png');
								}
								echo CHtml::image(Yii::app()->createUrl('images/pet/large/no_pet_avatar.png'));
							}
				 ?>
			</td>
			<td class="pet-profile-info">
				<table style="width: 100%;">
					<tbody>
						<tr>
							<td style="width: 25%; align:right;">
							<strong>	<?php echo Yii::t('pet','Name :'); ?></strong>
							</td>
							<td style="width: 70%; align:left;">
								<?php echo CHtml::encode($model->name); ?>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo Yii::t('pet','Alias :'); ?></strong>
							</td>
							<td>
								<?php echo CHtml::encode($model->nickname); ?>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo Yii::t('pet','Born On :'); ?></strong>
							</td>
							<td>
								<?php echo CHtml::encode($model->date_of_birth); ?>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo Yii::t('pet','Owned By :'); ?></strong>
							</td>
							<td>
								<?php echo CHtml::link(CHtml::encode($model->owner->username),array('/profile/profile/view','id'=>$model->owner->id)); ?>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo Yii::t('pet','Member since : '); ?></strong>
							</td>
							<td>
								<?php echo CHtml::encode($model->created); ?>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php echo Yii::t('pet','Last Update :'); ?></strong>
							</td>
							<td>
								<?php echo CHtml::encode($model->modified); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<br/>
<br/>
<?php if(isset($model->avatar) && !empty($model->avatar))
		echo CHtml::link(CHtml::encode(Yii::t('pet','Remove Avatar')),array('/pet/avatar/editAvatar','id'=>$model->id));
		else
			echo CHtml::link(CHtml::encode(Yii::t('pet','Upload Avatar')),array('/pet/avatar/editAvatar','id'=>$model->id)); ?>