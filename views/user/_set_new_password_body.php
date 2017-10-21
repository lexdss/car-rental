<?php
/**
 * Modal window body
 * @var app\models\forms\UserRegisterForm $userNewPassword
 * @var string $userEmail
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php if (!isset($success)): ?>

    <?php $form = ActiveForm::begin(['action' => Url::to(['user/set-new-password']), 'options' => ['data-pjax' => '']]); ?>
        <?= $form->field($userNewPassword, 'password')->passwordInput() ?>
        <?= $form->field($userNewPassword, 'password_repeat')->passwordInput() ?>
        <?= $form->field($userNewPassword, 'email', ['template' => '{input}'])->hiddenInput(['value' => $userEmail]) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info']) ?>
    <?php ActiveForm::end(); ?>

<?php else: ?>

    <div class="alert alert-success" role="alert">Новый пароль успешно установлен</div>

<?php endif; ?>