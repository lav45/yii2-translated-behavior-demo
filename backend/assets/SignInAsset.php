<?php

namespace backend\assets;

use yii\web\AssetBundle;

class SignInAsset extends AssetBundle
{
    public $sourcePath = '@backend/resource';

    public $css = [
        'css/signin.css'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapThemeAsset',
    ];
}
