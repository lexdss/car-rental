<?php

namespace app\models\admin\search;

use yii\data\ActiveDataProvider;
use app\models\User;

class UserSearch extends User
{

    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'email', 'phone'], 'safe']
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

        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if(!$this->validate())
            return $dataProvider;

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'surname', $this->surname])
        ->andFilterWhere(['like', 'patronymic', $this->patronymic])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}