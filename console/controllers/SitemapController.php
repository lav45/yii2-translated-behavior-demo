<?php
/**
 * Created by PhpStorm.
 * User: lav45
 * Date: 10.07.18
 * Time: 11:46
 */

namespace console\controllers;

use Yii;
use yii\di\Instance;
use yii\web\UrlManager;
use yii\console\Controller;
use samdark\sitemap\Sitemap;
use common\models\Lang;
use common\models\Post;

/**
 * Class SitemapController
 * @package console\controllers
 */
class SitemapController extends Controller
{
    /**
     * @var string
     */
    public $defaultAction = 'create';
    /**
     * @var string
     */
    public $path = '@frontend/web';
    /**
     * @var string|array|UrlManager
     */
    public $urlManager = 'frontendUrlManager';
    /**
     * @var Sitemap
     */
    private $sitemap;

    /**
     * Initializes the object.
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->path = Yii::getAlias($this->path);
        $this->urlManager = Instance::ensure($this->urlManager, UrlManager::class);
    }

    public function actionCreate()
    {
        $this->sitemap = new Sitemap($this->path . '/sitemap.xml', true);
        $this->addPages();
        $this->sitemap->write();
    }

    private function addPages()
    {
        $lang_list = array_keys(Lang::getList(true));

        $urls = [];
        foreach ($lang_list as $lang_id) {
            $urls[$lang_id] = $this->urlManager->createAbsoluteUrl(['/site/index',
                '_lang' => $lang_id,
            ]);
        }
        $this->sitemap->addItem($urls, time(), Sitemap::WEEKLY);

        $query = Post::find()
            ->select(['id', 'slug', 'updated_at'])
            ->where(['not', ['slug' => 'readme']])
            ->asArray();

        /** @var array $item */
        foreach ($query->each() as $item) {
            $urls = [];
            foreach ($lang_list as $lang_id) {
                $urls[$lang_id] = $this->urlManager->createAbsoluteUrl(['/site/view',
                    '_lang' => $lang_id,
                    'slug' => $item['slug']
                ]);
            }
            $this->sitemap->addItem($urls, $item['updated_at'], Sitemap::WEEKLY);
        }
    }
}