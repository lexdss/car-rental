<?php

/**
 * @var \app\models\Order $model
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_detail', ['model' => $model]); ?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusList); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
    </div>

<?php ActiveForm::end(); ?>

