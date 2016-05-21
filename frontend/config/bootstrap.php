<?php

\yii\base\Event::on('yii\base\Controller', 'beforeAction', function($event) {
    /** @var yii\filters\ContentNegotiator $negotiator */
    $negotiator = Yii::createObject([
        'class' => 'yii\filters\ContentNegotiator',
        'languages' => \common\models\Lang::getLocaleList(),
    ]);
    /** @var yii\base\ActionEvent $event */
    $negotiator->attach($event->action);
    $negotiator->negotiate();
});