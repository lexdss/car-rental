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
                'name',
                'surname',
                'patronymic',
                'email',
                'phone',
                [
                    'attribute' => 'add_date',
                    'format' => ['date', 'php:Y-m-d H:i']
                ]
            ]
        ]);

    ?>

</div>
