<?php

/**
 * @var \app\models\Order $model
 */

use yii\widgets\DetailView;
use yii\helpers\Html;

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'createDate:date',
        'statusName',
        [
            'attribute' => 'carFullName',
            'format' => 'raw',
            'value' => Html::a($model->carFullName, ['admin/car/view', 'id' => $model->car->id])
        ],
        [
            'attribute' => 'pickupDate',
            'format' => ['date', 'php:Y-m-d']
        ],
        [
            'attribute' => 'dropOffDate',
            'format' => ['date', 'php:Y-m-d']
        ],
        'userEmail',
        [
            'label' => 'Цена',
            'value' => $model->amount . ' руб.'
        ]
    ]
]);