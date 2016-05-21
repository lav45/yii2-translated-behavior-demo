<?php

require __DIR__ . '/../../vendor/lav45/yii2-translated-behavior/migrate/m151220_112320_lang.php';

use console\migrations\YiiDocsTrait;

class m151221_225031_lang extends m151220_112320_lang
{
    use YiiDocsTrait;

    public function safeUp()
    {
        parent::safeUp();

        $this->batchInsert('lang', ['id', 'name', 'locale', 'status'], $this->getLangRows());

        $this->update('lang', ['name' => Locale::getDisplayLanguage('en-US', 'en')], ['id' => 'en']);
    }

    /**
     * @return Generator|array
     */
    protected function getLangRows()
    {
        foreach ($this->getLanguages() as $locale) {
            $primaryLanguage = Locale::getPrimaryLanguage($locale);

            $displayLanguage = Locale::getDisplayLanguage($locale, $primaryLanguage);
            $displayLanguage = mb_convert_case($displayLanguage, MB_CASE_TITLE, "UTF-8");

            yield [$primaryLanguage, $displayLanguage, $locale, 10];
        }
    }
}
