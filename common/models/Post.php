<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use lav45\translate\TranslatedBehavior;
use lav45\translate\TranslatedTrait;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * Relations
 * @property PostLang $postLangs
 *
 * Translated attribute
 * @property string $title
 * @property string $description
 */
class Post extends ActiveRecord
{
    use TranslatedTrait;

    const SLUG_PATTERN = '[a-z0-9.\-_]+';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 128],
            [['title'], 'unique',
                'targetClass' => PostLang::class,
                'filter' => function(ActiveQuery $q) {
                    $q->andWhere(['not', ['post_id' => $this->id]]);
                }
            ],

            [['slug'], 'required', 'enableClientValidation' => false],
            [['slug'], 'string', 'max' => 128],
            [['slug'], 'match', 'pattern' => '/^' . self::SLUG_PATTERN . '$/'],
            [['slug'], 'unique'],

            [['updated_at', 'created_at'], 'integer'],

            [['description'], 'required'],
            [['description'], 'string'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TranslatedBehavior::class,
                'translateRelation' => 'postLangs',
                'translateAttributes' => [
                    'title',
                    'description'
                ]
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
            ],
            [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'created_at' => 'Created',
            'updated_at' => 'Update',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostLangs()
    {
        return $this->hasMany(PostLang::class, ['post_id' => 'id']);
    }
}
