<?php
Yii::import('application.modules.pet.models.Pet');
$pets =Pet::model()->findAll('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId()));
$petsArray= array();
foreach ($pets as $key => $value) {
	$petsArray[$value->id]=$value->name;
}
return array(
    'title' => 'Upload your image',
 
    'attributes' => array(
        'enctype' => 'multipart/form-data',
    ),
 
    'elements' => array(
        'image' => array(
            'type' => 'file',
        ),
    ),
    'buttons' => array(
        'reset' => array(
            'type' => 'reset',
            'label' => 'Reset',
        ),
        'submit' => array(
            'type' => 'submit',
            'label' => 'Upload',
        ),
    ),
);