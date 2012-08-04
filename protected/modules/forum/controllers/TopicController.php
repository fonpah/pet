<?php

class TopicController extends Controller
{
	private $path ="application.modules.forum.controllers.topic.";
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/lefty';

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
				'actions'=>array('create','update'),
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

	public function actions(){
		return array(
			'index'=>$this->path.'IndexAction',
			'view'=>$this->path.'ViewAction',
			'update'=>$this->path.'UpdateAction',
			'delete'=>$this->path.'DeleteAction',
			'admin'=>$this->path.'AdminAction',
			'create'=>$this->path.'CreateAction',
		);
	}
	
	public function loadForumModel($slug)
		{
			$model=Forum::model()->find('slug =:slug',array(':slug'=>$slug));
			if($model===null)
				throw new CHttpException(404,Yii::t('forum','The requested page does not exist.'));
			return $model;
		}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Topic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('forum', 'The requested page does not exist.'));
		return $model;
	}
	
	public function loadModelBySlug($slug)
	{
		$model=Topic::model()->find('slug=:slug',array(':slug'=>$slug));
		if($model===null)
			throw new CHttpException(404,Yii::t('forum', 'The requested page does not exist.'));
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='topic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
