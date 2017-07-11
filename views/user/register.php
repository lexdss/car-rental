<?php

/**
 * @var $model app\models\forms\UserRegisterForm
 */

use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = ['label' => 'Регистрация'];

$session = Yii::$app->session;
?>

<section class="register">
    <div class="container">
        <h2 class="text-center">Регистрация</h2>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 register-form">
                <?php if(!$session->hasFlash('register')): ?>
                    <?php $form = ActiveForm::begin() ?>

                        <?= $this->render('_register_form', ['form' => $form, 'registerForm' => $model]) ?>

                        <button type="submit" class="btn btn-primary">Регистрация</button>

                    <?php ActiveForm::end() ?>
                <?php else: ?>
                    <div class="alert alert-info" role="alert"><?= $session->getFlash('register') ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>