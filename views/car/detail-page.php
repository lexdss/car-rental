<?php

use yii\helpers\Url;

$this->title = 'Аренда автомобиля ' . $model->fullName;

?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li><a href="/">Главная</a></li>
					<li><a href="<?= Url::to(['car/company', 'company' => $model->company->code]); ?>"><?= $model->company->name; ?></a></li>
					<li class="active"><?= $model->name; ?></li>
				</ol>
			</div>
		</div>
	</div>
</section>
	
	<h1 class="text-center"><?= $model->fullName; ?></h1>
	<section class="detail-car-info">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-4 col-md-offset-2 detail-car-img">
					<img src="<?= $model->img; ?>" class="img-responsive img-thumbnail">
				</div>

				<div class="col-xs-12 col-md-4">
					<table class="table table-striped">
						<tr>
							<td>Цвет</td>
							<td><?= $model->color; ?></td>
						</tr>
						<tr>
							<td>Двигатель</td>
							<td><?= $model->engine; ?></td>
						</tr>
						<tr>
							<td>Коробка</td>
							<td><?= $model->transmission; ?></td>
						</tr>
						<tr>
							<td>Привод</td>
							<td><?= $model->privod; ?></td>
						</tr>
						<tr>
							<td>Макс. скорость</td>
							<td><?= $model->speed; ?> км/ч</td>
						</tr>
					</table>
					<button class="btn btn-primary btn-lg">Заказать</button>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<?= $model->description; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="popular">
		<div class="container">
			<div class="row">
				<h2 class="text-center mb20">Похожие предложения</h2>

				<div class="col-xs-12 col-sm-6 col-md-3">

					<div class="thumbnail thumbnail-item">
						<img src="img/popular-1.jpg" class="img-response">
						<div class="caption">

							<h3>BMW 5er VI</h3>
							<ul class="list-unstyled">
								<li>
									Год выпуска: <mark>2010</mark>
								</li>
								<li>
									Пробег: <mark>140 000 км</mark>
								</li>
								<li>
									Двигатель: <mark>3.0 л / дизель</mark>
								</li>
								<li>
									Коробка: <mark>Автоматическая</mark>
								</li>
								<li>
									Привод: <mark>Полный</mark>
								</li>
								<li>
									Руль: <mark>Левый</mark>
								</li>
								<li>
									Количество дверей: <mark>5</mark>
								</li>
								<li>
									Макс. скорость: <mark>190 км/ч</mark>
								</li>
							</ul>

							<button class="btn btn-success">
								Подробнее
							</button>

						</div>
					</div>

				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">

					<div class="thumbnail thumbnail-item">
						<img src="img/popular-2.jpg" class="img-response">
						<div class="caption">

							<h3>Hyundai ix55</h3>
							<ul class="list-unstyled">
								<li>
									Год выпуска: <mark>2010</mark>
								</li>
								<li>
									Пробег: <mark>140 000 км</mark>
								</li>
								<li>
									Двигатель: <mark>3.0 л / дизель</mark>
								</li>
								<li>
									Коробка: <mark>Автоматическая</mark>
								</li>
								<li>
									Привод: <mark>Полный</mark>
								</li>
								<li>
									Руль: <mark>Левый</mark>
								</li>
								<li>
									Количество дверей: <mark>5</mark>
								</li>
								<li>
									Макс. скорость: <mark>190 км/ч</mark>
								</li>
							</ul>

							<button class="btn btn-success">
								Подробнее
							</button>

						</div>
					</div>
					
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">

					<div class="thumbnail thumbnail-item">
						<img src="img/popular-3.jpg" class="img-response">
						<div class="caption">
							
							<h3>Audi A5 I</h3>
							<ul class="list-unstyled">
								<li>
									Год выпуска: <mark>2010</mark>
								</li>
								<li>
									Пробег: <mark>140 000 км</mark>
								</li>
								<li>
									Двигатель: <mark>3.0 л / дизель</mark>
								</li>
								<li>
									Коробка: <mark>Автоматическая</mark>
								</li>
								<li>
									Привод: <mark>Полный</mark>
								</li>
								<li>
									Руль: <mark>Левый</mark>
								</li>
								<li>
									Количество дверей: <mark>5</mark>
								</li>
								<li>
									Макс. скорость: <mark>190 км/ч</mark>
								</li>
							</ul>

							<button class="btn btn-success">
								Подробнее
							</button>

						</div>
					</div>
					
				</div>

				<div class="col-xs-12 col-sm-6 col-md-3">

					<div class="thumbnail thumbnail-item">
						<img src="img/popular-4.jpg" class="img-response">
						<div class="caption">

							<h3>Chevrolet Lacetti</h3>
							<ul class="list-unstyled">
								<li>
									Год выпуска: <mark>2010</mark>
								</li>
								<li>
									Пробег: <mark>140 000 км</mark>
								</li>
								<li>
									Двигатель: <mark>3.0 л / дизель</mark>
								</li>
								<li>
									Коробка: <mark>Автоматическая</mark>
								</li>
								<li>
									Привод: <mark>Полный</mark>
								</li>
								<li>
									Руль: <mark>Левый</mark>
								</li>
								<li>
									Количество дверей: <mark>5</mark>
								</li>
								<li>
									Макс. скорость: <mark>190 км/ч</mark>
								</li>
							</ul>

							<button class="btn btn-success">
								Подробнее
							</button>

						</div>
					</div>
					
				</div>

			</div><!-- /row --> 
		</div>
	</section>