<?php

/**
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $searchModel app\models\admin\search\UserSearch
 */

use yii\grid\GridView;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'
        ],
        'name',
        'surname',
        'patronymic',
        'email',
        'phone',
        [
            'attribute' => 'add_date',
            'format' => ['date', 'php:Y-m-d H:i']
        ]
    ]
]);




