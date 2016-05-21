<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AnchorJSAsset extends AssetBundle
{
    public $sourcePath = '@bower/anchor-js';

    public $js = [
        'anchor.min.js',
    ];
}
