<?php

/**
 * Show block with cars
 * @var app\models\Car[] $model
 */
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php if (!empty($model)): ?>
    <?php foreach($model as $car): ?>

        <div class="col-xs-12 col-sm-6 col-md-4 car-item">
            <div class="thumbnail car-thumbnail">
                <img src="<?= $car->img ?>" alt="<?= $car->fullName ?>" class="img-responsive">

                <div class="thumbnail-body">
                    <h3><?= Html::a($car->fullName, [Url::to(['site/car', 'value' => $car->slug])]) ?></h3>

                    <div class="option-icons">
                        <div class="conditioner">
                            <abbr title="<?= $car->getAttributeLabel('conditioner') . ': ' . $car->conditionerString ?>" class="initialism"><?= $car->conditionerChar ?></abbr>
                        </div>
                        <div class="passengers">
                            <abbr title="<?= $car->getAttributeLabel('passengers') . ': ' . $car->passengers ?>" class="initialism"><?= $car->passengers ?></abbr>
                        </div>
                        <div class="transmission">
                            <abbr title="<?= $car->getAttributeLabel('transmission') . ': ' . $car->transmission ?>" class="initialism"><?= $car->transmissionChar ?></abbr>
                        </div>
                        <div class="doors">
                            <abbr title="<?= $car->getAttributeLabel('doors') . ': ' . $car->doors ?>" class="initialism"><?= $car->doors ?></abbr>
                        </div>
                    </div>

                    <div class="car-description">
                        <span class="label label-success"><?= $car->categoryName ?></span>
                        <span class="label label-success"><?= $car->companyName ?></span>
                        <span class="label label-success">Скидка до <?= $car->maxDiscount->discount ?>%</span>
                    </div>

                    <div class="price-item">
                        <p><span class="small-text">от &#8381;</span><?= $car->minPrice ?><span class="small-text">/день</span></p>
                        <?= Html::a('Заказать', ['site/order', 'id' => $car->id], ['class' => 'btn btn-default btn-lg']) ?>

                    </div>
                </div>

            </div>
        </div>

    <?php endforeach; ?>
<?php endif; ?>