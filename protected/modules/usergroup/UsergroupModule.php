<?php
Yii::setPathOfAlias('UsergroupModule' , dirname(__FILE__));

class UsergroupModule extends CWebModule {
	public $usergroupTable = 'user_group';
	public $usergroupMessagesTable = 'user_group_message';
	public $controllerMap=array(
			'groups'=>array(
				'class'=>'UsergroupModule.controllers.YumUsergroupController'),
			);

	public function init() {
		$this->setImport(array(
					'application.modules.user.controllers.*',
					'application.modules.user.models.*',
					'application.modules.usergroup.controllers.*',
					'application.modules.usergroup.models.*',
					));
	}


}
