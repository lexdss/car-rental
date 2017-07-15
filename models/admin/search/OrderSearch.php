<?php

namespace app\models\admin\search;

use app\models\Order;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public $userEmail;
    public $carFullName;

    const SCENARIO_SEARCH = 'search';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'userEmail', 'carFullName'], 'trim'],
            [['status', 'userEmail', 'carFullName'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['status', 'userEmail', 'carFullName']
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->scenario = self::SCENARIO_SEARCH;

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
                    'status' => [
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

        $this->load($params);

        if (!$this->validate())
            return $dataProvider;

        $query->andFilterWhere(['status' => $this->status])
            ->andFilterWhere(['like', 'user.email', $this->userEmail])
            ->andFilterWhere(['like', "CONCAT(`company`.`name`, ' ', `car`.`name`)", $this->carFullName]);

        return $dataProvider;
    }
}