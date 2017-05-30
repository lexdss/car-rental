<?php

namespace app\models\admin\search;

use app\models\Order;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public $statusString;
    public $userEmail;

    const SCENARIO_SEARCH = 'search';

    public function rules()
    {
        return [
            [['statusString', 'userEmail'], 'trim'],
            [['statusString', 'userEmail'], 'safe']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['statusString', 'userEmail']
        ];
    }

    public function search($params)
    {
        $this->scenario = self::SCENARIO_SEARCH;

        $this->load($params);

        $query = Order::find()->joinWith('user');

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
                    ]
                ]
            ]
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['status' => $this->statusString]) // TODO разобраться со статусами
            ->andFilterWhere(['like', 'user.email', $this->userEmail]);

        return $dataProvider;
    }
}