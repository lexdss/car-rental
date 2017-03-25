<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Car */
/* @var $company app\models\Company */
/* @var $category app\models\Category */

$this->title = 'Изменение авто: ' . $model->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="car-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'company' => $company,
        'category' => $category
    ]) ?>

</div>
