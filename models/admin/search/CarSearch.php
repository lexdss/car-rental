<?php

namespace app\models\admin\search;

use yii\data\ActiveDataProvider;
use app\models\Car;

/**
 * CarSearch represents the model behind the search form about `app\models\Car`.
 */
class CarSearch extends Car
{
    public $categoryName;
    public $fullName;

    const SCENARIO_SEARCH = 'search';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['price', 'integer'],
            [['price', 'categoryName', 'fullName'], 'trim'],
            [['price', 'categoryName', 'fullName'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['price', 'categoryName', 'fullName']
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->scenario = self::SCENARIO_SEARCH;

        $query = Car::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'up_date' => SORT_DESC
                ],
                'attributes' => [
                    'up_date',
                    'price',
                    'fullName' => [
                        'asc' => ['company.name' => SORT_ASC, 'name' => SORT_ASC],
                        'desc' => ['company.name' => SORT_DESC, 'name' => SORT_DESC]
                    ],
                    'categoryName' => [
                        'asc' => ['category.name' => SORT_ASC],
                        'desc' => ['category.name' => SORT_DESC]
                    ]
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }

        $query->joinWith(['company', 'category']);

        $query->andFilterWhere(['like', "CONCAT(`company`.`name`, ' ', `car`.`name`)", $this->fullName]);
        $query->andFilterWhere(['like', 'category.name', $this->categoryName]);
        $query->andFilterWhere(['=', 'car.price', $this->price]);

        return $dataProvider;
    }
}
