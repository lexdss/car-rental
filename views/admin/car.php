<?php 

use yii\helpers\Url;

$this->title = 'Все авто';

?>

<section class="add_car_form">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4">

				<table class="table table-hover">
					<?php foreach($model as $car): ?>
						<tr>
							<td><a href=""><?= $car['company']['name'] . ' ' . $car['name']; ?></a></td>
							<td><a href="<?= Url::to(['admin/change-car', 'id' => $car['id']]); ?>" class="btn btn-primary">Редактировать</a> <a href="<?= Url::to(['admin/car', 'del' => $car['id']]); ?>" class="btn btn-warning">Удалить</a></td>
						</tr>
					<?php endforeach; ?>
				</table>				

			</div>
		</div>
	</div>
</section>