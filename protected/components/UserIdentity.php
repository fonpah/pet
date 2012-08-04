<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	public function authenticate()
	{
		Yii::import('application.modules.usermgmt.models.User');
		$model = User::model()->findByAttributes(array('username'=>$this->username));
		if($model===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($model->password!==crypt($this->password,Yii::app()->params['salt']))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			{
				$this->errorCode=self::ERROR_NONE;
				$this->_id = $model->id;
			}
		return !$this->errorCode;
	}
	public function getId(){
		return $this->_id;
	}
}