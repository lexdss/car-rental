<?php
/**
 * @var app\models\Page $model
 */
use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = Html::encode($model->name);
?>

<section class="page">
    <div class="container">
        <h1><?= Html::encode($model->name) ?></h1>
        <p class="text-muted"><small><?= $model->upDate ?></small></p>
        <?= $model->content ?>
    </div>
</section>