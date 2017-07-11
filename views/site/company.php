<?php

/**
 * Car company page
 * @var $company \app\models\Company
 */

use app\widgets\CarsBlock\CarsBlock;
use yii\helpers\Html;

$this->title = 'Автомобили ' . $company->name;
$this->params['breadcrumbs'][] = ['label' => $company->name];
?>

<section class="car-list">
    <div class="container">
        <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
        <p><?= $company->description ?></p>
        <?= CarsBlock::widget(['option' => 'company', 'value' => $company->id, 'count' => 10]) ?>
    </div>
</section>