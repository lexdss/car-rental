<?php

/**
 * @var $loginForm app\models\forms\LoginForm
 */

use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\User;


if (!isset($loginForm)) {
    $loginForm = new app\models\forms\LoginForm();
}

?>

<?php Pjax::begin(['enablePushState' => false, 'linkSelector' => '#logout', 'options' => ['class' => 'navbar-right']]); ?>

    <?php if (Yii::$app->user->isGuest): ?>
        <?php $form = ActiveForm::begin(['action' => Url::to(['user/login']), 'errorSummaryCssClass' => 'login-error text-warning', 'options' => ['class' => 'navbar-form navbar-right', 'data-pjax' => '']]); ?>

            <?= $form->field($loginForm, 'email', ['template' => '{input}'])->textInput(['placeholder' => 'E-mail']); ?>
            <?= $form->field($loginForm, 'password', ['template' => '{input}'])->passwordInput(['placeholder' => 'Пароль']); ?>
            <a href="<?= Url::to(['user/register']); ?>" class="navbar-text visible-xs">Регистрация</a>
            <?= Html::submitButton('Войти', ['class' => 'btn btn-default']) ?>

        <?php ActiveForm::end(); ?>

        <?php if ($loginForm->hasErrors()): ?>
            <div class="text-right login-message">
                <?= $form->errorSummary($loginForm, ['header' => '']) ?>  |  <?= Html::a('Восстановить пароль', ['#'], ['data-toggle' => 'modal', 'data-target' => '#forgot-password-modal'])?>
            </div>
        <?php endif; ?>

    <?php else: ?>

        <a href="<?= Url::to(['user/logout']); ?>" class="navbar-text navbar-right" id="logout">Выход</a>
        <?php if (Yii::$app->user->identity->role == User::ROLE_ADMIN): ?>
            <a href="<?= Url::to(['admin/admin/index']) ?>" class="navbar-text navbar-right">Администрирование</a>
        <?php endif; ?>

    <?php endif; ?>

<?php Pjax::end(); ?>