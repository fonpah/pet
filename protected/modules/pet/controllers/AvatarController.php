<?php

// This controller handles the upload and the deletion of an Avatar
// image for the user profile.


class AvatarController extends Controller {
	
	public function actionRemoveAvatar($id) {
		$model = Pet::model()->findByPk($id);
		
		$this->delete($model);
		$this->redirect(array(
					'//pet/pet/view', 'id' => $model->id));	
	}

	public function beforeAction($action) {
		// Disallow guests
		if(Yii::app()->user->isGuest)
			$this->redirect(Yum::module()->loginUrl);

		return parent::beforeAction($action);
	}

	public function actionEditAvatar($id) {
		$criteria =new CDbCriteria;
		$criteria->condition="pet.id=:id";
		$criteria->params=array(':id'=>$id);
		$criteria->alias='pet';
		$criteria->with=array('owner');
		$model = Pet::model()->find($criteria);

		if(isset($_POST['Pet'])) {
			$model->attributes = $_POST['Pet']['avatar'];
			$this->delete($model);

			$model->avatar = CUploadedFile::getInstanceByName('Pet[avatar]');
			if($model->validate()) {
				if ($model->avatar instanceof CUploadedFile) {

					// Prepend the id of the user to avoid filename conflicts
					$filename = 'images/pet/original/'.  $model->id . '_' . $_FILES['Pet']['name']['avatar'];
					$fname=$model->id.'_'.$_FILES['Pet']['name']['avatar'];
					$model->avatar->saveAs($filename);
					$model->avatar = $fname;
					if($model->save()) {
						$this->redirect(array('//pet/pet/view','id'=>$model->id));	
					}
				}
			}
		}

		$this->render('edit_avatar', array('model' => $model));
	}
	private function delete($model){
		$file =Yii::app()->file->set('images/pet/original/'.$model->avatar);
		if(isset($model->avatar) && !empty($model->avatar)){
			if ($file->exists){
				$file->delete();
			}
			$file =Yii::app()->file->set('images/pet/large/'.$model->avatar); 
			if($file->exists){
				$file->delete();
			}
			$file =Yii::app()->file->set('images/pet/small/'.$model->avatar);
			if($file->exists){
				$file->delete;
			}
		}
		
		
		$model->avatar = '';
		$model->save();
	}
}
