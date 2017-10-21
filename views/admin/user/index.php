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
        'fullName',
        'email',
        'phone',
        'addDate:date',
        [
            'class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'update' => false,
                'delete' => false
            ]
        ],
    ]
]);




