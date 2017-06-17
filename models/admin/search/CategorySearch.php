<?php

namespace app\models\admin\search;

use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\models\Category`.
 */
class CategorySearch extends Category
{
    const SCENARIO_SEARCH = 'search';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'short_description'], 'trim'],
            [['name', 'slug', 'short_description'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['name', 'slug', 'short_description']
        ];
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->scenario = self::SCENARIO_SEARCH;

        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'up_date' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate())
            return $dataProvider;

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
