<?php

/**
 * Detail car page
 * @var app\models\Car $model
 */

use yii\helpers\Url;
use yii\helpers\Html;
use app\widgets\CarsBlock\CarsBlock;

$this->title = ($model->title) ?: $model->fullName ;
$this->params['keywords'] = $model->keywords;
$this->params['description'] = $model->description;
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->companyName), 'url' => ['site/company', 'value' => Html::encode($model->company->slug)]];
$this->params['breadcrumbs'][] = Html::encode($model->fullName);
?>

<section class="detail-car">
    <div class="container">
        <div class="row">
            <h1 class="text-center"><?= Html::encode($model->fullName) ?></h1>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <img src="<?= Html::encode($model->img) ?>" alt="<?= Html::encode($model->fullName) ?>" class="img-responsive img-thumbnail">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 car-info">
                <h3>Характеристики</h3>
                <div class="hr"></div>
                <dl class="dl-horizontal">
                    <dt>Марка</dt>
                    <dd><?= Html::encode($model->companyName) ?></dd>
                    <dt>Класс авто</dt>
                    <dd><?= Html::encode($model->categoryName) ?></dd>

                    <?php foreach ($model->options as $name => $value): ?>
                        <?php if(isset($value)): ?>
                            <dt><?= $name ?></dt>
                            <dd><?= $value ?></dd>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </dl>
                <a href="<?= Url::to(['site/order', 'id' => $model->id]) ?>" class="btn btn-primary btn-lg btn-block">Оформить заказ</a>
            </div>
        </div>
        <div class="description">
            <h3>Описание</h3>
            <div class="hr"></div>
            <?= $model->content ?>
        </div>
    </div>
</section>

<section class="car-list">
    <div class="container">
        <div class="row">
            <h3 class="text-center">Похожие автомобили</h3>
            <div class="hr"></div>
            <?= CarsBlock::widget(['option' => 'category', 'value' => $model->categoryId, 'except' => $model->id]) ?>
        </div>
    </div>
</section>