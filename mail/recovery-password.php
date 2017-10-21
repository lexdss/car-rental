<?php
/**
 * @var string $userHash
 */

use yii\helpers\Url;

?>

<p>Вы запросили восстановление пароля. Для продолжения пройдите по ссылке: </p><?= Url::to(['user/set-new-password', 'userHash' => $userHash]) ?>