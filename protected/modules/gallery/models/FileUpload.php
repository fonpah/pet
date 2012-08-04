<?php
class FileUpload extends CFormModel {
 
    public $image;
 	public $pet_id;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            //note you wont need a safe rule here
            array('image', 'file', 'allowEmpty' => false, 'types' => 'jpg, jpeg, gif, png'),
            array('pet_id','required'),
        );
    }
 
}