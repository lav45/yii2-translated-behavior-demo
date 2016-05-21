<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "post_lang".
 *
 * @property integer $post_id
 * @property string $lang_id
 * @property string $title
 * @property string $description
 */
class PostLang extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'lang_id', 'title', 'description'], 'required'],
            [['post_id'], 'integer'],
            [['description'], 'string'],
            [['lang_id'], 'string', 'max' => 2],
            [['title'], 'string', 'max' => 128],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'lang_id' => 'Lang ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
