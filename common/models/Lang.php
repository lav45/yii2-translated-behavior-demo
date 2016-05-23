<?php
/**
 * Created by PhpStorm.
 * User: lav45
 * Date: 30.03.16
 * Time: 23:43
 */

namespace common\models;

use Yii;
use yii\caching\TagDependency;

class Lang extends \lav45\translate\models\Lang
{
    public static $cacheKey = 'lastModify::Lang';

    public function getStatusName()
    {
        return $this->status !== null ? $this->getStatusList()[$this->status] : null;
    }

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        parent::afterDelete();
        $this->invalidateCache();
    }

    /**
     * @inheritdoc
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!empty($changedAttributes)) {
            $this->invalidateCache();
        }
    }

    public function invalidateCache()
    {
        TagDependency::invalidate(Yii::$app->cache, self::$cacheKey);
    }

    /**
     * @return TagDependency
     */
    public static function getDependency()
    {
        return new TagDependency(['tags' => self::$cacheKey]);
    }

    /**
     * @param bool $active default false
     * @return array
     */
    public static function getList($active = false)
    {
        return self::getDb()->cache(function() use ($active) {
            return parent::getList($active);
        }, null, self::getDependency());
    }

    /**
     * @param bool $active default true
     * @return array
     */
    public static function getLocaleList($active = true)
    {
        return self::getDb()->cache(function() use ($active) {
            return parent::getLocaleList($active);
        }, null, self::getDependency());
    }
}