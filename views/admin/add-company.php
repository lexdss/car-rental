<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавить марку автомобиля';
$session = \Yii::$app->session;
$session->open();

?>

<section class="add_car_form">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4">

				<p class="text-warning"><strong><?= $session->getFlash('message'); ?></strong></p>
				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

					<?= $form->field($model, 'name'); ?>

					<?= $form->field($model, 'logo')->fileInput(); ?>

					<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']); ?>

				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>