<?php
/**
 * All News
 * @var app\models\Page $model
 */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = 'Новости';
// TODO Html link, dates
?>

<section class="news">
    <div class="container">
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>

                <div class="news-item">
                    <h2>
                        <a href="<?= Url::to(['site/page', 'type' => 'news', 'value' => $model->slug]) ?>"><?= Html::encode($model->name) ?></a>
                    </h2>
                    <p class="text-muted"><small>14.07.2017 17:53</small></p>
                    <p><?= $model->previewContent ?></p>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
