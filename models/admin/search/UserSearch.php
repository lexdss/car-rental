<?php

namespace app\models\admin\search;

use yii\data\ActiveDataProvider;
use app\models\User;

class UserSearch extends User
{
    const SCENARIO_SEARCH = 'search';

    public $fullName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullName', 'email', 'phone'], 'trim'],
            [['fullName', 'email', 'phone'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['fullName', 'email', 'phone']
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->scenario = self::SCENARIO_SEARCH;

        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
                'attributes' => [
                    'id',
                    'email',
                    'phone',
                    'add_date',
                    'fullName' => [
                        'asc' => ['name' => SORT_ASC, 'surname' => SORT_ASC, 'patronymic' => SORT_ASC],
                        'desc' => ['name' => SORT_DESC, 'surname' => SORT_DESC, 'patronymic' => SORT_DESC]
                    ]
                ]
            ]
        ]);

        $this->load($params);

        if(!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', "CONCAT(`name`, ' ', `surname`, ' ', `patronymic`)", $this->fullName])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}