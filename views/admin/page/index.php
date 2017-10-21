<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Page;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'type',
                'filter' => Page::TYPES
            ],
            'slug',
            'upDate:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
