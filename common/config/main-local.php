<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=korforum',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
			'on afterOpen' => function($event) { 
					$event->sender->createCommand("SET time_zone='+05:30';")->execute(); 
				},
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
	'id' => 'kor_forum',
    'name'=>'KOR FORUM',
];
