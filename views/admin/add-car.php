<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Добавить автомобиль';
$session = \Yii::$app->session;
$session->open();

?>

<section class="add_car_form">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4">

				<p class="text-warning"><strong><?= $session->getFlash('message'); ?></strong></p>
				<?php $form = ActiveForm::begin(['id' => 'add_car_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
					
					<?= $form->field($model, 'name'); ?>
					
					<?= $form->field($model, 'company_id')->dropDownList($company, ['prompt' => '']); ?>
					
					<?= $form->field($model, 'type')->dropDownList(\Yii::$app->params['type'], ['prompt' => '']); ?>
					
					<?= $form->field($model, 'year'); ?>
					
					<?= $form->field($model, 'speed', [
						'template' => '{label}<div class="input-group">{input}<span class="input-group-addon">км/ч</span></div><div class="help-block">{error}</div>'
					]); ?>
					
					<?= $form->field($model, 'engine'); ?>
					
					<?= $form->field($model, 'color'); ?>
					
					<?= $form->field($model, 'transmission')->dropDownList(\Yii::$app->params['transmission'], ['prompt' => '']);?>
					
					<?= $form->field($model, 'privod')->dropDownList(\Yii::$app->params['privod'], ['prompt' => '']);?>

					<?= $form->field($model, 'description')->textarea();?>

					<?= $form->field($model, 'img')->fileInput(); ?>

					<div class="form-group">
						<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']); ?>
					</div>
				
				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>