<?php

Yii::$container->set('lav45\translate\TranslatedBehavior', [
    'primaryLanguage' => function($lang_id) {
        $locales = \common\models\Lang::getLocaleList();
        $locales = array_flip($locales);

        return $locales[$lang_id];
    }
]);