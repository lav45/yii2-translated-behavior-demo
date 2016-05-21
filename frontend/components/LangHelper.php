<?php
/**
 * Created by PhpStorm.
 * User: loal
 * Date: 23.04.15
 * Time: 12:16
 */

namespace frontend\components;

use Yii;
use yii\base\Object;
use yii\helpers\Url;
use Locale;

class LangHelper extends Object
{
    /**
     * @var array|\Closure
     *  example Array
     *  (
     *      [en] => ENG
     *      [ru] => RUS
     *  )
     */
    public $langs;

    public $langAttribute = '_lang';

    public $currentLang;

    public function init()
    {
        parent::init();
        if (is_callable($this->langs)) {
            $this->langs = call_user_func($this->langs);
        }
        if (empty($this->currentLang)) {
            $this->currentLang = Locale::getPrimaryLanguage(Yii::$app->language);
        }
    }

    /**
     * @return \Generator
     */
    public function getList()
    {
        $items = [];
        foreach((array)$this->langs as $lang_id => $urlName) {
            $items[] = [
                'label' => $urlName,
                'active' => $lang_id == $this->currentLang,
                'url' => Yii::$app->getErrorHandler()->exception !== null ?
                    Url::toRoute([Yii::$app->getHomeUrl(), $this->langAttribute => $lang_id]) :
                    Url::current([$this->langAttribute => $lang_id]),
            ];
        }
        return $items;
    }
}