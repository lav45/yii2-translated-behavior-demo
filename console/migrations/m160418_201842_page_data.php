<?php

use yii\db\Migration;
use yii\helpers\Markdown;
use yii\web\AssetManager;
use console\migrations\YiiDocsTrait;
use common\components\HTMLDocument;
use common\models\Post;

class m160418_201842_page_data extends Migration
{
    use YiiDocsTrait;
    /**
     * @var Post[]
     */
    private $_models = [];
    /**
     * @var array
     */
    private $_publishUrl = [];
    /**
     * @var array config for AssetManager
     */
    public $assetManager = [
        'class' => AssetManager::class,
    ];

    public function init()
    {
        parent::init();

        Yii::setAlias('@webroot', '@frontend/web');
        Yii::setAlias('@web', '/');

        Yii::$app->set('assetManager', $this->assetManager);
    }

    public function up()
    {
        $docs = $this->getDocs();
        rsort($docs);

        foreach ($docs as $path) {
            $data = $this->parseData($path);
            $model = $this->getPostModel($data['slug']);

            Yii::configure($model, $data);

            $model->save(false);
        }
    }

    protected function parseData($path)
    {
        preg_match('~guide-?(.*)/(.+)\.md$~', $path, $matches);

        $language = $matches[1] ? $matches[1] : Yii::$app->sourceLanguage;
        $language = Locale::getPrimaryLanguage($language);

        $slug = strtolower($matches[2]);

        $doc = file_get_contents($path);
        $doc = Markdown::process($doc, 'gfm');

        $html = new HTMLDocument();
        @$html->loadHTML($doc);

        $html->addPrefix("/{lang}/", 'a', 'href');

        $imgPath = dirname($path) . '/images';
        $imgPath = $this->publishImages($imgPath);
        if ($imgPath) {
            $html->addPrefix(function ($src) use ($imgPath) {
                return $imgPath . '/' . basename($src);
            }, 'img', 'src');
        }

        foreach (['h1', 'h2', 'h3', 'h4'] as $tag) {
            /** @var \DOMElement $item */
            foreach ($html->getElementsByTagName($tag) as $item) {
                /** @var \DOMElement $span */
                if ($span = $item->getElementsByTagName('span')[0]) {
                    $item->setAttribute('id', $span->getAttribute('id'));
                }
            }
        }

        /** @var DOMElement $title */
        $title = $html->getElementsByTagName('h1')[0];

        return [
            'language' => $language,
            'slug' => $slug,
            'title' => $title->textContent,
            'description' => $html->saveHTML()
        ];
    }
    
    /**
     * @param string $imgPath
     * @return string
     */
    protected function publishImages($imgPath)
    {
        if (!isset($this->_publishUrl[$imgPath])) {
            $this->_publishUrl[$imgPath] = is_dir($imgPath) ?
                Yii::$app->assetManager->publish($imgPath)[1] : false;
        }

        return $this->_publishUrl[$imgPath];
    }

    /**
     * @param string $id
     * @return Post
     */
    protected function getPostModel($id)
    {
        if (!isset($this->_models[$id])) {
            $this->_models[$id] = new Post();
        }
        return $this->_models[$id];
    }
}
