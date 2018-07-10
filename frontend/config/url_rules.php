<?php

use yii\web\UrlRule;
use common\models\Lang;
use common\models\Post;

return [
    '<_lang:'. Lang::PATTERN .'>' => 'site/index',
    [
        'pattern' => '',
        'route' => 'site/index',
        'class' => UrlRule::class,
    ],
    '<_lang:'. Lang::PATTERN .'>/<slug:' . Post::SLUG_PATTERN . '>.md' => 'site/view',
    '<_lang:'. Lang::PATTERN .'>/doc' => 'site/doc',
];