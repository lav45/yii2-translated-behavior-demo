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
    'homeUrl' => '/',
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
        ],
        'request' => [
            'baseUrl' => '',
        ],
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'ruleConfig' => ['class' => 'lav45\translate\web\UrlRule'],
            'rules' => [
                '<_lang:'. Lang::PATTERN .'>' => 'site/index',
                [
                    'pattern' => '',
                    'route' => 'site/index',
                    'class' => 'yii\web\UrlRule',
                ],
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
