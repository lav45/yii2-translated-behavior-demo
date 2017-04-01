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
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@frontend/runtime/cache'
        ],
        'session' => [
            'class' => 'yii\web\CacheSession'
        ],
        'formatter' => [
            'timeFormat' => 'H:mm',
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy H:mm',
        ],
    ],
];
