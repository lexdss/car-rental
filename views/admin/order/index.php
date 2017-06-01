<?php

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\admin\search\OrderSearch $searchModel
 */

use yii\grid\GridView;
//use Yii;

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        [
            'attribute' => 'statusLine',
            'filter' => Yii::$app->params['orderStatus']
        ],
        'userEmail',
        'carFullName',
        [
            'attribute' => 'price',
            'label' => 'Цена, руб.'
        ],
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