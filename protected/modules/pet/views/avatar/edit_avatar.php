<div class="form">
<?php
$this->breadcrumbs = array(
		Yii::t('pet','Pet Profile') => array('//pet/pet/view','id'=>$model->id),
		Yii::t('pet','Upload avatar'));

if($model->avatar) {
	echo '<h2>';
	echo $model->name.Yii::t('pet','\'s Avatar image');
	echo '</h2>';
	echo CHtml::image(Yii::app()->createUrl('images/pet/large/'.$model->avatar));
}
else
	echo Yum::t('You do not have set an avatar image yet');

	echo '<br />';

	echo CHtml::errorSummary($model);
	echo CHtml::beginForm(array(
				'//pet/avatar/editAvatar'), 'POST', array(
	'enctype' => 'multipart/form-data'));
	echo '<div class="row">';
	echo CHtml::activeLabelEx($model, 'avatar');
	echo CHtml::activeFileField($model, 'avatar');
	echo CHtml::error($model, 'avatar');
	echo '</div>';

	echo CHtml::Button(Yii::t('pet','Remove Avatar'), array(
				'submit' => array(
					'//pet/avatar/removeAvatar','id'=>$model->id)));
	echo CHtml::submitButton(Yii::t('pet','Upload Avatar'),
				array(
				'submit' => array(
					'//pet/avatar/editAvatar','id'=>$model->id)));
	echo CHtml::endForm();

?>
</div>
