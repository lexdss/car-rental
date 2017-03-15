<?php 

use yii\helpers\Url;

?>

<section class="popular">
	<div class="container">
		<div class="row">

			<?php foreach($model as $car): ?>
				<div class="col-xs-12 col-sm-6 col-md-3">

					<div class="thumbnail thumbnail-item">
						<img src="<?= $car->img ;?>" class="img-response">
						<div class="caption">

							<h3><?= $car->fullName; ?></h3>
							<ul class="list-unstyled">
								<li>
									Год выпуска: <mark><?= $car->year; ?></mark>
								</li>
								<li>
									Цвет: <mark><?= $car->color; ?></mark>
								</li>
								<li>
									Двигатель: <mark><?= $car->engine; ?></mark>
								</li>
								<li>
									Коробка: <mark><?= $car->transmissionName; ?></mark>
								</li>
								<li>
									Привод: <mark><?= $car->privodName; ?></mark>
								</li>
								<li>
									Макс. скорость: <mark><?= $car->speed; ?></mark>
								</li>
							</ul>

							<a href="<?= Url::to(['car/index', 'car' => $car->code, 'company' => $car->company->code]); ?>" class="btn btn-success">
								Подробнее
							</a>

						</div>
					</div>

				</div>
			<?php endforeach; ?>

		</div><!-- /row --> 
	</div>
</section>