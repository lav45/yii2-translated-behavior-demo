<?php
return [
    'bootstrap' => ['log'],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:@common/data/db.sqlite',
            'enableSchemaCache' => true,
            'charset' => 'utf8',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error', 'warning'],
                    'message' => [
                        'to' => ['lav451@gmail.com'],
                        'subject' => "Error on yii2-translated-behavior.lav45.com",
                    ],
                ],
            ],
        ],
    ],
];
