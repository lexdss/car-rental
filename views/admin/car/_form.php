<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use unclead\multipleinput\MultipleInput;
use vova07\imperavi\Widget;

/**
 *
 * @var $this yii\web\View
 * @var $model app\models\Car
 * @var $form yii\widgets\ActiveForm
 * @var $company app\models\Company
 * @var $category app\models\Category
 * @var $modelDiscount app\models\Discount
 */

?>

<div class="car-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['id' => 'add-car']]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'company_id')->dropDownList(ArrayHelper::map(ArrayHelper::toArray($company), 'id', 'name')) ?>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(ArrayHelper::toArray($category), 'id', 'name')) ?>
        <?= $form->field($model, 'year')->textInput() ?>
        <?= $form->field($model, 'speed')->textInput() ?>
        <?= $form->field($model, 'engine')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'transmission')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'privod')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'imageUpload' => Url::to(['/site/image-upload']),
                'imageManagerJson' => Url::to(['/site/images-get']),
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager',
                    'fontsize'
                ]
            ]
        ]) ?>
        <?= $form->field($model, 'price')->textInput() ?>
        <?= $form->field($model, 'discount')->widget(MultipleInput::className(),[
                'columns' => [
                    [
                        'name' => 'days',
                        'title' => 'От дней',
                        'enableError' => true
                    ],
                    [
                        'name' => 'discount',
                        'title' => 'Скидка, %',
                        'enableError' => true
                    ]
                ]
        ]) ?>

        <?php if ($model->img): ?>
            <div class="img-responsive admin-thumb-img"><img src="<?= $model->img ?>" alt=""></div>
        <?php endif ?>

        <?= $form->field($model, 'file')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end() ?>

</div>
