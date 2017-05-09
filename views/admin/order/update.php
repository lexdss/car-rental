<?php

use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'attribute' => 'create_date',
            'format' => ['date', 'php:Y-m-d H:i']
        ],
        [
            'attribute' => 'start_rent',
            'format' => ['date', 'php:Y-m-d']
        ],
        [
            'attribute' => 'end_rent',
            'format' => ['date', 'php:Y-m-d']
        ],
        'price'
    ]
]); ?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusList); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
    </div>

<?php ActiveForm::end(); ?>

