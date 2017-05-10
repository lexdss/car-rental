<?php

namespace app\models\admin\search;

use app\models\Order;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    const SCENARIO_SEARCH = 'search';

    public function rules()
    {
        return [
            [['price', 'statusString'], 'safe']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['price', 'statusString']
        ];
    }

    public function search($params)
    {
        $this->load($params);

        $query = Order::find();

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
                    ]
                ]
            ]
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}