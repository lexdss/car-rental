<?php

namespace app\models\admin\search;

use yii\data\ActiveDataProvider;
use app\models\User;

class UserSearch extends User
{
    const SCENARIO_SEARCH = 'search';

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'email', 'phone'], 'safe']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['name', 'surname', 'patronymic', 'email', 'phone']
        ];
    }

    /**
     * @param $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->load($params);

        $query = User::find()->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if(!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}