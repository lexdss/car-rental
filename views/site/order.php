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
                <?php if(!$session->hasFlash('orderConfirm')): ?>
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

                    <?=
                        $form->field($orderModel, 'start_rent')->widget(
                                DatePicker::classname(),
                                ['clientOptions' => ['dateFormat' => 'yy']]
                            );
                    ?>

                    <?=
                        $form->field($orderModel, 'end_rent')->widget(
                                DatePicker::classname()
                            );
                    ?>

                    <div>
                        <p>Скидка: <span id="discount">0</span>%</p>
                        <p>Итого: <span id="price">0</span> руб</p>
                    </div>

                    <button type="submit" class="btn btn-primary">Подтвердить</button>

                    <?php ActiveForm::end(); ?>
                <?php else: ?>
                    <h3 class="text-warning text-center"><?= $session->getFlash('orderConfirm') ?></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
