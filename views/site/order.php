<?php

/**
 * @var $registerModel app\models\forms\UserRegisterForm
 * @var $orderModel app\models\Order;
 * @var $car app\models\Car
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = 'Подтверждение заказа';
$this->params['breadcrumbs'][] = ['label' => 'Оформление заказа'];

$session = Yii::$app->session;
?>

<section class="order">
    <div class="container">
        <?php if (!$session->getFlash('order')): ?>
            <h2 class="text-center">Оформление заказа</h2>
            <div class="row">
                <div class="panel panel-default car-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= Html::encode($car->fullName); ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <img src="<?= Html::encode($car->img); ?>" class="img-responsive">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <?php if (!empty($car->discount)): ?>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Дней</th>
                                            <th>Скидка</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($car->discount as $discount): ?>
                                            <tr class="">
                                                <td>От <?= Html::encode($discount->days); ?></td>
                                                <td><?= Html::encode($discount->discount); ?>%</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 description">
                                <?= Html::encode($car->shortDescription); ?>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-2">
                                <a href="<?= Url::to(['site/car', 'value' => $car->slug]); ?>" class="btn btn-info btn-block info">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row order-form">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 register-form">
                    <?php $form = ActiveForm::begin(); ?>

                        <?php if(Yii::$app->user->isGuest && $registerModel): ?>
                            <h3 class="text-center">Регистрация пользователя</h3>
                            <?= $this->render('@app/views/user/_register_form', ['form' => $form, 'registerForm' => $registerModel]); ?>
                        <?php endif; ?>

                    <h3 class="text-center">Сроки аренды</h3>
                    <div class="form-group order-dates">
                        <div class="row">
                            <div class="col-sm-6 start-rent">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    <?= $form->field($orderModel, 'start_rent', ['template' => '{input}'])
                                        ->textInput()
                                        ->widget(DatePicker::className(), ['options' => ['class' => 'form-control']]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-6 end-rent">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    <?= $form->field($orderModel, 'end_rent', ['template' => '{input}'])
                                        ->textInput()
                                        ->widget(DatePicker::className(), ['options' => ['class' => 'form-control']]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-success order-info" role="alert">
                        <p>Срок аренды: <span id="days">0</span> дней</p>
                        <p>Скидка: <span id="discount">0</span>%</p>
                        <p><span class="text-uppercase">Итого</span>: <span id="amount">0</span> руб.</p>
                    </div>

                    <button type="submit" class="btn btn-primary">Оформить</button>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert"><?= $session->getFlash('order'); ?></div>
        <?php endif; ?>
    </div>
</section>










