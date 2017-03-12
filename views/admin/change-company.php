<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактировать марку автомобиля';

?>

<section class="change-form">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4">

				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

					<?= $form->field($model, 'name'); ?>

					<?= $form->field($model, 'code'); ?>

					<div><img src="<?= $model->img; ?>" class="img-response"></div>

					<?= $form->field($model, 'img')->fileInput(); ?>

					<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>

				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>