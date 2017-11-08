<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PostSearch extends Model
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var bool
     */
    public $advancedSearch;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()
            ->with('currentTranslate'); // For display data

        // Need to filter data based on search criteria
        if ($this->advancedSearch === true) {
            $query->joinWith('postLangs', false);
        } else {
            $query->joinWith('currentTranslate', false);
        }

        $query->groupBy('id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['title'] = [
            'asc' => ['post_lang.title' => SORT_ASC],
            'desc' => ['post_lang.title' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['LIKE', 'title', $this->title]);

        return $dataProvider;
    }
}