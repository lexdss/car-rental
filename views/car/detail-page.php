<?php

use yii\helpers\Url;
use app\widgets\CarsBlock\CarsBlock;

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
							<td>Тип авто</td>
							<td><?= $model->typeName; ?></td>
						</tr>
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
							<td><?= $model->transmissionName; ?></td>
						</tr>
						<tr>
							<td>Привод</td>
							<td><?= $model->privodName; ?></td>
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

	<?= CarsBlock::widget(['option' => 'type', 'value' => $model->type, 'except' => $model->id]); ?>