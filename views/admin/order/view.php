<?php

/**
 * @var \app\models\Order $model
 */

use yii\helpers\Html;

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<p>
    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
</p>

<?= $this->render('_detail', ['model' => $model]); ?>
