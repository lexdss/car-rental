<?php

/**
 * @var $model app\models\User
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Пользователь: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=

        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'fullName',
                'email',
                'phone',
                'addDate:date'
            ]
        ]);

    ?>

</div>
