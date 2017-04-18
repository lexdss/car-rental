<?php

/**
 * @var $registerModel app\models\forms\UserRegisterForm
 * @var $orderModel app\models\Order;
 * @var $car app\models\Car
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Подтверждение заказа';

$session = Yii::$app->session;
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <?php if(!$session->hasFlash('order')): ?>
                    <?php $form = ActiveForm::begin(); ?>

                    <p><strong>Автомобиль:</strong> <a href="<?= Url::to(['site/car', 'value' => $car->slug]); ?>"><?= $car->fullName; ?></a></p>

                    <?php if(Yii::$app->user->isGuest && $registerModel): ?>

                        <?= $form->field($registerModel, 'name')->textInput() ?>

                        <?= $form->field($registerModel, 'surname')->textInput() ?>

                        <?= $form->field($registerModel, 'patronymic')->textInput() ?>

                        <?= $form->field($registerModel, 'email')->textInput() ?>

                        <?= $form->field($registerModel, 'phone')->textInput() ?>

                        <?= $form->field($registerModel, 'password')->passwordInput() ?>

                        <?= $form->field($registerModel, 'password_repeat')->passwordInput() ?>

                    <?php endif; ?>

                    <?= $form->field($orderModel, 'start_rent', ['template' => '{input}{error}'])->widget(DatePicker::classname(), ['clientOptions' => ['altField' => '#end_rent', 'minDate' => 0]]) ?>

                    <?= $form->field($orderModel, 'end_rent')->widget(DatePicker::classname(), ['options' => ['id' => 'end_rent'], 'clientOptions' => ['altField' => '#end_rent', 'minDate' => 0]]) ?>

                    <div>
                        <p>Скидка: 5%</p>
                        <p>Итого: 856 руб</p>
                    </div>

                    <button type="submit" class="btn btn-primary">Подтвердить</button>

                    <?php ActiveForm::end(); ?>
                <?php else: ?>
                    <h3 class="text-warning text-center"><?= $session->getFlash('order') ?></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
