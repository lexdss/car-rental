<?php

/**
 * Car's category page
 * @var $category \app\models\Category
 */

use app\widgets\CarsBlock\CarsBlock;
use yii\helpers\Html;

$this->title = 'Автомобили ' . $category->name;
$this->params['breadcrumbs'][] = ['label' => Html::encode($category->name)];
?>

<section class="car-list">
    <div class="container">
        <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
        <p><?= $category->content ?></p>
        <div class="row">
            <?= CarsBlock::widget(['option' => 'category', 'value' => $category->id, 'count' => 10]) ?>
        </div>
    </div>
</section>