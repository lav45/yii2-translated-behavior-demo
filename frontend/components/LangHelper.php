<?php
/**
 * Created by PhpStorm.
 * User: LAV45
 * Date: 23.04.15
 * Time: 12:16
 */

namespace frontend\components;

use Yii;
use yii\helpers\Url;
use common\models\Lang;

/**
 * Class LangHelper
 * @package frontend\components
 */
class LangHelper
{
    /**
     * @var array
     *  example Array
     *  (
     *      [en] => ENG
     *      [ru] => RUS
     *  )
     */
    private $list;
    /**
     * @var string property in request params
     */
    public $langAttribute = '_lang';
    /**
     * @var string
     */
    private $currentId;

    public function __construct()
    {
        $this->list = Lang::getList(true);
    }

    /**
     * @return string
     */
    protected function getCurrentId()
    {
        if ($this->currentId !== null) {
            return $this->currentId;
        }
        $locales = Lang::getLocaleList();
        $locales = array_flip($locales);

        $this->currentId = $locales[Yii::$app->language];

        return $this->currentId;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        $currentLang = $this->getCurrentId();
        if (isset($this->list[$currentLang])) {
            return $this->list[$currentLang];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $items = [];
        $currentLang = $this->getCurrentId();
        $errorHandler = Yii::$app->getErrorHandler();
        foreach($this->list as $lang_id => $urlName) {
            $items[] = [
                'label' => $urlName,
                'active' => $lang_id === $currentLang,
                'url' => $errorHandler->exception !== null ?
                    Url::toRoute([Yii::$app->getHomeUrl(), $this->langAttribute => $lang_id]) :
                    Url::current([$this->langAttribute => $lang_id]),
            ];
        }
        return $items;
    }
}