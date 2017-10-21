<?php

use yii\helpers\Url;

?>

<p>Здравствуйте, <?= $user->surname ?> <?= $user->name ?>. Вы успешно зарегистрировались на сайте <a href="http://esrent.ru">esrent.ru</a></p>
<p>Ваш логин для входа на сайт: <strong><?= $user->email ?></strong></p>