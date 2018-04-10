<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'dateFormat' => 'php:j M Y',
			'datetimeFormat' => 'php:j M Y H:i',
			'timeFormat' => 'php:H:i',
			'timeZone' => 'Asia/Kolkata',
		],
	],
	'timeZone'=>'Asia/Kolkata',
];
