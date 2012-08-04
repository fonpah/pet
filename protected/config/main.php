<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'PET PORTAL',
	//'theme'=>'dancer',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.image.components.*',
        'application.modules.image.models.Image',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'forum',
		'pet',
		'gallery',
		'registration'=>array(
			'enableRegistration' => true,
            'enableCaptcha' => true,
		),
		//'usermgmt',
		'user' => array(
			'debug' => false,
			'userTable' => 'user',
			'translationTable' => 'translation',
			),
			'usergroup' => array(
			'usergroupTable' => 'user_group',
			'usergroupMessagesTable' => 'user_group_message',
			),
			/*'membership' => array(
			'membershipTable' => 'membership',
			'paymentTable' => 'payment',
			),*/
			'friendship' => array(
			'friendshipTable' => 'friendship',
			),
			'profile' => array(
			'privacySettingTable' => 'privacysetting',
			'profileFieldTable' => 'profile_field',
			'profileTable' => 'profile',
			'profileCommentTable' => 'profile_comment',
			'profileVisitTable' => 'profile_visit',
			),
			'role' => array(
			'roleTable' => 'role',
			'userRoleTable' => 'user_role',
			'actionTable' => 'action',
			'permissionTable' => 'permission',
			),
			'message' => array(
			'messageTable' => 'message',
			),
			'avatar',
			'shop' => array( 'debug' => 'true'),
	),

	// application components
	'components'=>array(
		'user'=>array(
			      'class' => 'application.modules.user.components.YumWebUser',
			      'allowAutoLogin'=>true,
			      'loginUrl' => array('//user/user/login')),
		'cache' => array('class' => 'system.caching.CDummyCache'),
	    'phpThumb'=>array(
			'class'=>'application.extensions.EPhpThumb.EPhpThumb',
		),
		'file'=>array(
        'class'=>'application.extensions.cfile.CFile',
    	),
    
		/*'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
			'itemTable'=>'items',
			'assignmentTable'=>'assignments',
			'itemChildTable'=>'itemchildren'),*/
		/*'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),*/
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			//'urlSuffix'=>'.html',
			'showScriptName'=>false,
			'useStrictParsing'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',)
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=hr',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'nongho',
			'charset' => 'utf8',
			'tablePrefix'=>'',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'securityManager'=>array(
			'class'=>'CSecurityManager'
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
				array(
					'class'=>'CDbLogRoute',
					'levels'=>'trace, info',
					'categories'=>'application.*'
				),
			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'salt'=>'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9m0',
	),
	'aliases'=>array(
		'xupload'=>'application.extensions.xupload'
	),
);