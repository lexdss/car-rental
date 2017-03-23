<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить авто', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'companyName',
            'name',
            'slug',
            'price',
            'categoryName',
            [
                'attribute' => 'up_date',
                'format' => ['date', 'php:Y-m-d H:i']
            ],
            // 'year',
            // 'speed',
            // 'engine',
            // 'color',
            // 'transmission',
            // 'privod',
            // 'description',
            // 'discount_1',
            // 'discount_2',
            // 'img',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
