<?php

/**
 * @var $loginForm app\models\forms\LoginForm
 */

use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;


if (!isset($loginForm)) {
    $loginForm = new app\models\forms\LoginForm();
}

?>

<?php Pjax::begin(['options' => ['class' => 'navbar-right']]); ?>

    <?php if (Yii::$app->user->isGuest): ?>
        <?php $form = ActiveForm::begin(['action' => '/login', 'errorSummaryCssClass' => 'login-error text-warning', 'options' => ['class' => 'navbar-form navbar-right', 'data' => ['pjax' => true]]]); ?>

            <?= $form->field($loginForm, 'email', ['template' => '{input}'])->textInput(['placeholder' => 'E-mail']); ?>
            <?= $form->field($loginForm, 'password', ['template' => '{input}'])->passwordInput(['placeholder' => 'Пароль']); ?>
            <a href="<?= Url::to(['user/register']); ?>" class="navbar-text visible-xs">Регистрация</a>
            <?= Html::submitButton('Войти', ['class' => 'btn btn-default']) ?>

        <?php ActiveForm::end(); ?>

        <?php if ($loginForm->hasErrors()): ?>
            <div class="text-right login-message">
                <?= $form->errorSummary($loginForm, ['header' => '']) ?> <a href="#">| Напомнить пароль</a>
            </div>
        <?php endif; ?>

    <?php else: ?>

        <a href="<?= Url::to(['user/logout']); ?>" class="navbar-text navbar-right">Выход</a>
        <?php if (Yii::$app->user->identity->role === 'admin'): ?>
            <a href="<?= Url::to(['admin/admin/index']) ?>" class="navbar-text navbar-right">Администрирование</a>
        <?php else: ?>
            <a href="" class="navbar-text navbar-right">Профиль</a>
        <?php endif; ?>

    <?php endif; ?>

<?php Pjax::end(); ?>