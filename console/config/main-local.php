<?php
return [
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
		'rbac' => [
            'class' => 'yii2mod\rbac\ConsoleModule',
        ],
    ],
	'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
	],
];
