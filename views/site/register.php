<?php

/**
 * @var $model app\models\forms\UserRegisterForm
 */

use yii\widgets\ActiveForm;

$this->title = 'Регистрация';

$session = Yii::$app->session;
?>

<?php if(!$session->hasFlash('register')): ?>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput() ?>

        <?= $form->field($model, 'surname')->textInput() ?>

        <?= $form->field($model, 'patronymic')->textInput() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <button type="submit" class="btn btn-primary">Регистрация</button>

    <?php ActiveForm::end(); ?>
<?php else: ?>
    <h3 class="text-warning text-center"><?= $session->getFlash('register') ?></h3>
<?php endif; ?>
