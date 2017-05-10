<?php

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\grid\GridView;

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'
        ],
        'statusString',
        'price',
        [
            'attribute' => 'start_rent',
            'format' => ['date', 'php:Y-m-d']
        ],
        [
            'attribute' => 'end_rent',
            'format' => ['date', 'php:Y-m-d']
        ],
        [
            'attribute' => 'create_date',
            'format' => ['date', 'php:Y-m-d H:i']
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'delete' => false
            ]
        ]
    ]
]);