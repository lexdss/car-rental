<?php

use yii\widgets\DetailView;

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'create_date',
                'format' => ['date', 'php:Y-m-d H:i']
            ],
            'statusString',
            [
                'attribute' => 'start_rent',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'end_rent',
                'format' => ['date', 'php:Y-m-d']
            ],
            'price'
        ]
    ]); ?>
