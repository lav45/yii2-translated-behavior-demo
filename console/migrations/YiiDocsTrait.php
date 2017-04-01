<?php

namespace console\migrations;

use Yii;
use Generator;

/**
 * Created by PhpStorm.
 * User: lav45
 * Date: 19.05.16
 * Time: 0:32
 */
trait YiiDocsTrait
{
    /**
     * @var string Path to documents root
     */
    public $docPath = '@yii2Docs';

    /**
     * @return array
     */
    protected function getGuides()
    {
        $docPath = Yii::getAlias($this->docPath);
        return glob($docPath . '/guide*');
    }

    /**
     * @return Generator
     */
    protected function getLanguages()
    {
        foreach ($this->getGuides() as $path) {
            preg_match('~guide-(.*)$~', $path, $matches);
            if (empty($matches[1])) {
                continue;
            }
            yield $matches[1];
        }
    }

    /**
     * @return array
     */
    protected function getDocs()
    {
        $docPath = Yii::getAlias($this->docPath);
        return glob($docPath . '/guide*/*.md');
    }
}