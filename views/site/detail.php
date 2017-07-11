<?php

/**
 * Detail car page
 *
 * @var $model \app\models\Car
 */

use yii\helpers\Url;
use yii\helpers\Html;
use app\widgets\CarsBlock\CarsBlock;

$this->title = 'Аренда автомобиля ' . $model->fullName;
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->companyName), 'url' => ['site/company', 'value' => Html::encode($model->company->slug)]];
$this->params['breadcrumbs'][] = Html::encode($model->fullName);

?>

<section class="detail-car">
    <div class="container">
        <div class="row">
            <h1 class="text-center"><?= Html::encode($model->fullName); ?></h1>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <img src="<?= Html::encode($model->img); ?>" alt="<?= Html::encode($model->fullName); ?>" class="img-responsive img-thumbnail">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 car-info">
                <h3>Характеристики</h3>
                <div class="hr"></div>
                <dl class="dl-horizontal">
                    <dt>Марка</dt>
                    <dd><?= Html::encode($model->companyName); ?></dd>
                    <dt>Класс авто</dt>
                    <dd><?= Html::encode($model->categoryName); ?></dd>
                    <dt>Год выпуска</dt>
                    <dd><?= Html::encode($model->year); ?></dd>
                    <dt>Макс. скорость</dt>
                    <dd><?= Html::encode($model->speed); ?></dd>
                    <dt>Двигатель</dt>
                    <dd><?= Html::encode($model->engine); ?></dd>
                    <dt>Цвет кузова</dt>
                    <dd><?= Html::encode($model->color); ?></dd>
                    <dt>КПП</dt>
                    <dd><?= Html::encode($model->transmission); ?></dd>
                    <dt>Привод</dt>
                    <dd><?= Html::encode($model->privod); ?></dd>
                    <dt>Цена</dt>
                    <dd><?= Html::encode($model->price); ?></dd>
                </dl>
                <a href="<?= Url::to(['site/order', 'id' => $model->id]); ?>" class="btn btn-primary btn-lg btn-block">Оформить заказ</a>
            </div>
        </div>
        <div class="description">
            <h3>Описание</h3>
            <div class="hr"></div>
            <?= $model->description ?>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <h3 class="text-center">Похожие автомобили</h3>
            <div class="hr"></div>

            <?= CarsBlock::widget(['option' => 'category', 'value' => $model->category_id, 'except' => $model->id]); ?>
        </div>
    </div>
</section>