<?php

/**
 * Show block with cars
 */
use yii\helpers\Url;

?>

<section class="popular">
	<div class="container">
		<div class="row">
            <?php if (!empty($model)): ?>
			<?php foreach($model as $car): ?>
				<div class="col-xs-12 col-sm-6 col-md-3">

					<div class="thumbnail thumbnail-item">
						<img src="<?= $car->img ;?>" class="img-response">
						<div class="caption">

							<h3><?= $car->fullName; ?></h3>
							<ul class="list-unstyled">
								<li>
                                    <?= $car->getAttributeLabel('year') ?>: <mark><?= $car->year; ?></mark>
								</li>
								<li>
                                    <?= $car->getAttributeLabel('color') ?>: <mark><?= $car->color; ?></mark>
								</li>
								<li>
                                    <?= $car->getAttributeLabel('engine') ?>: <mark><?= $car->engine; ?></mark>
								</li>
								<li>
                                    <?= $car->getAttributeLabel('transmission') ?>: <mark><?= $car->transmission; ?></mark>
								</li>
								<li>
                                    <?= $car->getAttributeLabel('privod') ?>: <mark><?= $car->privod; ?></mark>
								</li>
								<li>
                                    <?= $car->getAttributeLabel('speed') ?>: До <mark><?= $car->speed; ?> км/ч</mark>
								</li>
                                <li>
                                    <?= $car->getAttributeLabel('price') ?>: <mark>От <?= $car->price; ?> руб</mark>
                                </li>
							</ul>

							<a href="<?= Url::to(['site/car', 'value' => $car->code]); ?>" class="btn btn-success">
								Подробнее
							</a>

						</div>
					</div>

				</div>
			<?php endforeach; ?>
            <?php endif; ?>

		</div><!-- /row --> 
	</div>
</section>