<?php

namespace app\models\admin\search;

use app\models\Company;
use app\models\Order;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public $statusString;
    public $userEmail;
    public $carFullName;

    const SCENARIO_SEARCH = 'search';

    public function rules()
    {
        return [
            [['statusString', 'userEmail', 'carFullName'], 'trim'],
            [['statusString', 'userEmail', 'carFullName'], 'safe']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['statusString', 'userEmail', 'carFullName']
        ];
    }

    public function search($params)
    {
        $this->scenario = self::SCENARIO_SEARCH;

        $this->load($params);

        $query = Order::find()->joinWith(['user', 'car', 'company']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
                'attributes' => [
                    'id',
                    'price',
                    'start_rent',
                    'end_rent',
                    'create_date',
                    'statusString' => [
                        'asc' => ['status' => SORT_ASC],
                        'desc' => ['status' => SORT_DESC],
                    ],
                    'userEmail' => [
                        'asc' => ['user.email' => SORT_ASC],
                        'desc' => ['user.email' => SORT_DESC],
                    ],
                    'carFullName' => [
                        'asc' => ['car.name' => SORT_ASC, 'company.name' => SORT_ASC],
                        'desc' => ['car.name' => SORT_DESC, 'company.name' => SORT_DESC]
                    ]
                ]
            ]
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['status' => $this->statusString]);
        $query->andFilterWhere(['like', 'user.email', $this->userEmail]);
        $query->andFilterWhere(['like', "CONCAT(`company`.`name`, ' ', `car`.`name`)", $this->carFullName]);
        return $dataProvider;
    }
}