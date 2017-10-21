<?php

/**
 * @var $form yii\widgets\ActiveForm
 * @var $registerForm app\models\forms\UserRegisterForm
 */
?>

<?= $form->field($registerForm, 'name')->textInput() ?>
<?= $form->field($registerForm, 'surname')->textInput() ?>
<?= $form->field($registerForm, 'patronymic')->textInput() ?>
<?= $form->field($registerForm, 'email')->textInput() ?>
<?= $form->field($registerForm, 'phone')->textInput() ?>
<?= $form->field($registerForm, 'password')->passwordInput() ?>
<?= $form->field($registerForm, 'password_repeat')->passwordInput() ?>