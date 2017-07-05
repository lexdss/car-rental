<?php

/**
 * Show block with cars
 */
use yii\helpers\Url;

?>

<?php if (!empty($model)): ?>
    <?php foreach($model as $car): ?>
        <div class="panel panel-primary car-panel">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $car->fullName; ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <img src="<?= $car->img; ?>" class="img-responsive">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <?php if (!empty($car->discount)): ?>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Дней</th>
                                    <th>Скидка</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($car->discount as $discount): ?>
                                    <tr class="">
                                        <td>От <?= $discount->days; ?></td>
                                        <td><?= $discount->discount; ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 description">
                        <?= $car->shortDescription; ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="<?= Url::to(['site/car', 'value' => $car->slug]); ?>" class="btn btn-info btn-block info">Подробнее</a>
                        <a href="<?= Url::to(['site/order', 'id' => $car->id]); ?>" class="btn btn-primary btn-block order">Заказать</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>