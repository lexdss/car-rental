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
        'create_date:date',
        'statusLine',
        [
            'attribute' => 'carFullName',
            'format' => 'raw',
            'value' => Html::a($model->carFullName, ['admin/car/view', 'id' => $model->car->id])
        ],
        [
            'attribute' => 'start_rent',
            'format' => ['date', 'php:Y-m-d']
        ],
        [
            'attribute' => 'end_rent',
            'format' => ['date', 'php:Y-m-d']
        ],
        'userEmail',
        [
            'label' => 'Цена',
            'value' => $model->price . ' руб.'
        ]
    ]
]);