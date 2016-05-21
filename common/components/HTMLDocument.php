<?php
/**
 * Created by PhpStorm.
 * User: lav45
 * Date: 30.03.16
 * Time: 22:53
 */

namespace common\components;

use yii\base\InvalidConfigException;

/**
 * Class HTMLDocument
 * @package frontend\components
 */
class HTMLDocument extends \DOMDocument
{
    public function __construct($version = '1.0', $encoding = 'UTF-8')
    {
        parent::__construct($version, $encoding);
        $this->preserveWhiteSpace = true;
    }

    public function loadHTML($source, $options = 0)
    {
        $source = <<<HTML
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>$source</body>
</html>
HTML;
        return parent::loadHTML($source, $options);
    }

    /**
     * @param string|array|\Closure $prefix
     * @param string $tag
     * @param string $attr
     * @throws InvalidConfigException
     */
    public function addPrefix($prefix, $tag, $attr)
    {
        /** @var \DOMElement $item */
        foreach ($this->getElementsByTagName($tag) as $item) {
            $value = $item->getAttribute($attr);
            if (!empty($value) && substr($value, 0, 4) !== 'http' && $value[0] !== '#') {
                if (is_string($prefix)) {
                    $value = $prefix . $value;
                } elseif (is_callable($prefix)) {
                    $value = call_user_func($prefix, $value);
                } else {
                    throw new InvalidConfigException('Incorrect configuration $prefix params');
                }
                $item->setAttribute($attr, $value);
            }
        }
    }

    public function saveHTML()
    {
        preg_match('/<body>(.*)<\/body>/s', parent::saveHTML(), $match);
        return isset($match[1]) ? $match[1] : null;
    }
}