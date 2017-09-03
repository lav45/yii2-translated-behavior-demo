<?php
return [
    'vendorPath' => $root . '/vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@yii2Docs' => $root . '/../yii2/docs',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache'
        ],
        'session' => [
            'class' => 'yii\web\CacheSession'
        ],
        'formatter' => [
            'timeFormat' => 'H:mm',
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy H:mm',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['noreply@lav45.com' => 'yii2-translated-behavior.lav45.com'],
            ],
        ],
    ],
];
