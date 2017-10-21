<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\widgets\InputFields\InputFields;
use unclead\multipleinput\MultipleInput;
use vova07\imperavi\Widget;

/**
 *
 * @var $this yii\web\View
 * @var $model app\models\Car
 * @var $form yii\widgets\ActiveForm
 * @var $modelDiscount app\models\Discount
 */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['id' => 'add-car']]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'companyId')->dropDownList(ArrayHelper::map(ArrayHelper::toArray($model->companies), 'id', 'name'), ['prompt' => '']) ?>
        <?= $form->field($model, 'categoryId')->dropDownList(ArrayHelper::map(ArrayHelper::toArray($model->categories), 'id', 'name'), ['prompt' => '']) ?>

        <h2 class="text-center">Опции</h2>
        <hr>
        <?= $form->field($model, 'doors')->textInput() ?>
        <?= $form->field($model, 'passengers')->textInput() ?>
        <?= $form->field($model, 'conditioner')->dropDownList($model->conditionerOptions) ?>
        <?= $form->field($model, 'transmission')->textInput() ?>
        <?= $form->field($model, 'engine')->textInput() ?>
        <?= $form->field($model, 'speed')->textInput() ?>
        <?= $form->field($model, 'fuelConsumption')->textInput() ?>
        <?= $form->field($model, 'drive')->textInput() ?>
        <?= $form->field($model, 'trunkVolume')->textInput() ?>
        <?= $form->field($model, 'bodyStyle')->textInput() ?>
        <?= $form->field($model, 'color')->textInput() ?>
        <?= $form->field($model, 'year')->textInput() ?>
        <?= $form->field($model, 'content')->widget(Widget::className(), [
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

        <h2 class="text-center">SEO</h2>
        <hr>
        <?= $form->field($model, 'title')->textInput() ?>
        <?= $form->field($model, 'keywords')->textInput() ?>
        <?= $form->field($model, 'description')->textInput() ?>

        <hr>
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
