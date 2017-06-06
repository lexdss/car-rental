<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model app\models\Car
 * @var $company app\models\Company
 * @var $category app\models\Category
 * @var $modelDiscount app\models\Discount
 */

$this->title = 'Добавление авто';
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'company' => $company,
        'category' => $category
    ]) ?>

</div>
