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
					
					<?= $form->field($model, 'company_id')->dropDownList($company); ?>
					
					<?= $form->field($model, 'type')->dropDownList([
																	'' => '',
																	'business' => 'Бизнес класс', 
																	'middle' => 'Средний класс', 
																	'vip' => 'VIP класс',
																	'economy' => 'Эконом класс'
																]); ?>
					
					<?= $form->field($model, 'year'); ?>
					
					<?= $form->field($model, 'speed', [
						'template' => '{label}<div class="input-group">{input}<span class="input-group-addon">км/ч</span></div><div class="help-block">{error}</div>'
					]); ?>
					
					<?= $form->field($model, 'engine'); ?>
					
					<?= $form->field($model, 'color'); ?>
					
					<?= $form->field($model, 'transmission')->dropDownList([
																				'' => '',
																				'automat' => 'Автомат',
																				'mechanic' => 'Механика'
																			]);?>
					
					<?= $form->field($model, 'privod')->dropDownList([
																		'' => '',
																		'all' => 'Полный',
																		'front' => 'Передний', 
																		'rear' => 'Задний'
																	]);?>

					<?= $form->field($model, 'description')->textarea();?>

					<?= $form->field($model, 'foto')->fileInput(); ?>

					<div class="form-group">
						<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']); ?>
					</div>
				
				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</section>