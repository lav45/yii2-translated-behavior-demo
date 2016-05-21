<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Lang;
use frontend\components\LangHelper;

AppAsset::register($this);

$gitHubLogo = '<svg height="16" class="octicon" version="1.1" viewBox="0 0 16 16" width="28"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59 0.4 0.07 0.55-0.17 0.55-0.38 0-0.19-0.01-0.82-0.01-1.49-2.01 0.37-2.53-0.49-2.69-0.94-0.09-0.23-0.48-0.94-0.82-1.13-0.28-0.15-0.68-0.52-0.01-0.53 0.63-0.01 1.08 0.58 1.23 0.82 0.72 1.21 1.87 0.87 2.33 0.66 0.07-0.52 0.28-0.87 0.51-1.07-1.78-0.2-3.64-0.89-3.64-3.95 0-0.87 0.31-1.59 0.82-2.15-0.08-0.2-0.36-1.02 0.08-2.12 0 0 0.67-0.21 2.2 0.82 0.64-0.18 1.32-0.27 2-0.27 0.68 0 1.36 0.09 2 0.27 1.53-1.04 2.2-0.82 2.2-0.82 0.44 1.1 0.16 1.92 0.08 2.12 0.51 0.56 0.82 1.27 0.82 2.15 0 3.07-1.87 3.75-3.65 3.95 0.29 0.25 0.54 0.73 0.54 1.48 0 1.07-0.01 1.93-0.01 2.2 0 0.21 0.15 0.46 0.55 0.38C13.71 14.53 16 11.53 16 8 16 3.58 12.42 0 8 0z"></path></svg>';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app', 'Yii2 Documentation'),
        'brandUrl' => ['/site/index'],
        'options' => [
            'class' => 'navbar-default',
            'style' => 'margin-bottom: 0;'
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => Yii::t('app', 'Backend'), 'url' => '/admin'],
        ],
    ]);

    $langHelper = new LangHelper([
        'langs' => Lang::getList(true)
    ]);
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => $langHelper->langs[$langHelper->currentLang],
                'items' => $langHelper->getList(),
            ],
            [
                'label' => $gitHubLogo . 'GitHub',
                'url' => 'https://github.com/LAV45/yii2-translated-behavior',
                'linkOptions' => ['target' => '_blank'],
                'encode' => false,
            ]
        ]
    ]);
    NavBar::end();
    ?>
    <main class="jumbotron" role="main" style="margin-bottom: 0;">
        <div class="container text-center">
            <h1>Yii2 translated behavior</h1>
            <p class="lead">
                <?= Yii::t('app', 'This extension helps you to quickly add the ability to translate your website.')?>
            </p>
            <p>
                <img alt="Latest Stable Version" src="https://poser.pugx.org/lav45/yii2-translated-behavior/v/stable">
                <img alt="Total Downloads" src="https://poser.pugx.org/lav45/yii2-translated-behavior/downloads">
                <img alt="Code Coverage" src="https://scrutinizer-ci.com/g/lav45/yii2-translated-behavior/badges/coverage.png?b=master">
                <img alt="Scrutinizer Code Quality" src="https://scrutinizer-ci.com/g/lav45/yii2-translated-behavior/badges/quality-score.png?b=master">
            </p>
        </div>
    </main>
    <section class="notice-previous">
        <div class="container text-center">
            <?= Yii::t('app', 'Below is documentation <strong>Yii2 Framework</strong> in different languages.')?><br>
            <?= Yii::t('app', 'Translations of some languages are not fully completed yet, but that does not stop to view any text.')?><br>
            <?= Yii::t('app', 'Here you can see <strong>Yii2 translated behavior</strong> at work.')?>
        </div>
    </section>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; LAV45</p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
