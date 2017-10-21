<?php
/**
 * Modal window body
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\RecoveryPassword;

if (!isset($recoveryPassword)) {
    $recoveryPassword = new RecoveryPassword();
}

?>

<?php if (!isset($success)): ?>

    <?php $form = ActiveForm::begin(['action' => Url::to(['user/recovery-password']), 'options' => ['data-pjax' => '']]); ?>
        <?= $form->field($recoveryPassword, 'email')->textInput() ?>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-info']) ?>
    <?php ActiveForm::end(); ?>

<?php else: ?>
    <!--  If user exist  -->
    <div class="alert alert-success" role="alert">Данные для восстановления отправлены на ваш e-mail</div>

<?php endif; ?>
