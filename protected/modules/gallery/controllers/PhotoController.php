<?php
class PhotoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
			$model = new FileUpload();
		    $form = new CForm('application.modules.gallery.views.photo.create', $model);
		        if ($form->submitted('submit') && $form->validate()) {
		            $form->model->image = CUploadedFile::getInstance($form->model, 'image');
		            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		            //do something with your image here
		            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		            Yii::app()->user->setFlash('success', 'File Uploaded');
		            $this->redirect(array('create'));
		        }
	        $this->render('create', array('form' => $form));
			/*if(isset($_POST['Photo']))
			{
				$model=new Photo;	
				$model->attributes=$_POST['Photo'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}*/
	
			/*$this->render('create',array(
				'model'=>$model,
			));*/
	}
	
	public function actionUpload() {
		$dir =  Yii::getPathOfAlias('application.images.pet');
		Yii::import('application.modules.pet.models.Pet');
		$photos= Photo::model()->findAll('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId()));
		$uploaded = false;
        $model = new FileUpload;
		if(isset($_POST['FileUpload'])){
			$model->attributes=$_POST['FileUpload'];
			$model->image = CUploadedFile::getInstanceByName('FileUpload[image]');
            if ($model->image instanceof CUploadedFile) {
            	if($model->validate()){
            		$this->createDir();
            		$filename =$_POST['FileUpload']['pet_id'].'_'.$model->image->getName();
            		$uploaded=$model->image->saveAs('images/pet/'.$_POST['FileUpload']['pet_id'].'/'.$filename);
					$photo = new Photo;
					$photo->filename=$filename;
					$photo->pet_id=$model->pet_id;
					$photo->user_id =Yii::app()->user->getId();
					$photo->save();
					$this->redirect('upload', array('model' => $model,'uploaded'=>$uploaded,'dir'=>$dir,'photos'=>$photos));
            	}
					
			}
		}
        $this->render('upload', array('model' => $model,'uploaded'=>$uploaded,'dir'=>$dir,'photos'=>$photos));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Photo']))
		{
			$model->attributes=$_POST['Photo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Photo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Photo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Photo']))
			$model->attributes=$_GET['Photo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Photo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function createDir(){
		Yii::import('application.modules.pet.models.Pet');
		$pets = Pet::model()->findAll('user_id=:user_id',array(':user_id'=>Yii::app()->user->getId()));
		foreach ($pets as $key => $value) {
			$dir =Yii::app()->file->set('images/pet/'.$value->id); 
			if(!$dir->exists && !$dir->isdir){
				$dir->createdir();
			}
		}
		//return $pets;
		
	}
}
