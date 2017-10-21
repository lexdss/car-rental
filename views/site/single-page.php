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
        <div class="content">
            <?= $model->content ?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>