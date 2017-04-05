<?php

/**
 * @var $model app\models\forms\LoginForm
 */

use yii\widgets\ActiveForm;

$this->title = 'Вход';

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'email')->textInput(); ?>

                    <?= $form->field($model, 'password')->passwordInput(); ?>

                    <button type="submit" class="btn btn-primary">Войти</button>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>