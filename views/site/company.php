<?php

/**
 * Car company page
 *
 * @var $company \app\models\Company
 * @var $model \app\models\Car[]
 */

use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = 'Автомобили ' . $company->name;
$this->params['breadcrumbs'][] = $company->name;

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div>
</section>

<section class="car-list">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <?php if($model): ?>
                    <h2 class="text-center">Список доступных автомобилей</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th><?= $model[0]->getAttributeLabel('name') ?></th>
                            <th class="year"><?= $model[0]->getAttributeLabel('year') ?></th>
                            <th><?= $model[0]->getAttributeLabel('price') ?></th>
                        </tr>
                        </thead>
                        <?php foreach($model as $car): ?>
                            <tr>
                                <td>
                                    <img src="<?= $car->img; ?>" alt="" class="img-responsive">
                                </td>
                                <td><a href="<?= Url::to(['site/car', 'value' => $car->code]); ?>"><?= $car->fullName; ?></a></td>
                                <td class="year"><?= $car->year; ?> год</td>
                                <td>От <?= $car->price; ?> руб/день</td>
                                <td><button class="btn btn-success">Заказать</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <h2 class="text-center text-warning">В данный момент автомобилей <?= $company->name ?> нет</h2>
                <?php endif; ?>
            </div>

            <div class="col-xs-12">
                <?= $company->description ?>
            </div>
        </div>
    </div>
</section>