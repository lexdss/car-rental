<?php

namespace app\models\admin\search;

use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form about `app\models\Company`.
 */
class CompanySearch extends Company
{
    const SCENARIO_SEARCH = 'search';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'trim'],
            [['name', 'slug'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['name', 'slug']
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

        $query = Company::find();

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
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
