<?php

/**
 * @var app\models\User $user
 * @var app\models\Order $order
 */
?>
<p>Уважаемый <?= $user->surname ?> <?= $user->name ?>, вы заказали аренду автомобиля на сайте EasyRent.ru</p>
<p><strong>Ваш заказ:</strong></p>
<p><strong>Автомобиль</strong>: <?= $order->car->fullName ?></p>
<p><strong>Начало аренды</strong>: <?= $order->startRent ?></p>
<p><strong>Конец аренды</strong>: <?= $order->endRent ?></p>
<strong>Скидка</strong>: <?= $order->discount ?>
<strong>ИТОГО</strong>: <?= $order->price ?> руб.

<p>В ближайшее время с вами свяжется наш менеджер.</p>
