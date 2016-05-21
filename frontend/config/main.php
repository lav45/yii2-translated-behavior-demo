<?php

use common\models\Lang;
use common\models\Post;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => [],
    'homeUrl' => '/',
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
        ],
        'request' => [
            'baseUrl' => '',
        ],
        'urlManager' => [
            'class' => 'lav45\translate\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<_lang:'. Lang::PATTERN .'>' => 'site/index',
                '<_lang:'. Lang::PATTERN .'>/<slug:' . Post::SLUG_PATTERN . '>.md' => 'site/view',
                '<_lang:'. Lang::PATTERN .'>/doc' => 'site/doc',
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
