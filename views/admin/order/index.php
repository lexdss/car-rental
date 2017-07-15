<?php

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\admin\search\OrderSearch $searchModel
 */

use yii\grid\GridView;
use app\models\Order;

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        [
            'attribute' => 'status',
            'filter' => Order::STATUSES,
            'value' => function ($model) {
                return $model->statusName;
            }
        ],
        'userEmail',
        'carFullName',
        [
            'attribute' => 'price',
            'label' => 'Цена, руб.'
        ],
        'start_rent:date',
        'end_rent:date',
        'create_date:date',
        [
            'class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'delete' => false
            ]
        ]
    ]
]);