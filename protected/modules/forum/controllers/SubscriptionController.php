<?php

class SubscriptionController extends Controller
{
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','index','view'),
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
		$crit = new CDbCriteria;
		$crit->condition='subscription.id=:id';
		$crit->alias='subscription';
		$crit->params=array(':id'=>$id);
		$crit->with=array('forum','owner','topic');
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
		$model=new Subscription;
			if(isset($_POST['isAjax']) && $_POST['isAjax']){
				if(isset($_POST['Subscription']) ){
					if($_POST['Subscription']['action']=="Subscribe"){
						$model->user_id =$_POST['Subscription']['user_id'];
						$model->topic_id =$_POST['Subscription']['topic_id'];
						$model->forum_id =$_POST['Subscription']['forum_id'];
						if($model->save()){
							echo "Unsubscribe";
						}
						
					}else{
						$model= Subscription::model()->find('forum_id=:forum_id AND topic_id=:topic_id AND user_id=:user_id',
															array(':forum_id'=>$_POST['Subscription']['forum_id'],
															':user_id'=>$_POST['Subscription']['user_id'],
															':topic_id'=>$_POST['Subscription']['topic_id']
															)
														);
				        if($model!==null)
						$model->delete();													
					}
					
				}
			}
			else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		/*if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Subscription'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));*/
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

		if(isset($_POST['Subscription']))
		{
			$model->attributes=$_POST['Subscription'];
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
		$crit = new CDbCriteria;
		$crit->condition='owner.id=:id';
		$crit->alias='subscription';
		$crit->params=array(':id'=>Yii::app()->user->getId());
		$crit->with=array('forum','owner','topic');
		$dataProvider=new CActiveDataProvider('Subscription',array('criteria'=>$crit));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Subscription('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Subscription']))
			$model->attributes=$_GET['Subscription'];

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
		$model=Subscription::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='subscription-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
