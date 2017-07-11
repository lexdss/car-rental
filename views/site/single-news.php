<?php
/**
 * @var app\models\Page $model
 * @var app\models\Page[] $moreNews
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['site/news']];
$this->params['breadcrumbs'][] = Html::encode($model->name);
?>

<section class="page">
    <div class="container">
        <h1><?= Html::encode($model->name) ?></h1>
        <p class="text-muted"><small><?= $model->upDate ?></small></p>
        <?= $model->content ?>

        <?php if (!empty($moreNews)): ?>
            <div class="other-page">
                <div class="row">
                    <?php foreach ($moreNews as $news): ?>

                        <div class="item col-xs-12 col-sm-6">
                            <small class="text-muted"><?= $news->upDate ?></small><br>
                            <a href="<?= Url::to(['site/page', 'type' => $news->type,'value' => $news->slug]) ?>"><?= Html::encode($news->name) ?></a>
                            <div><?= Html::encode($news->shortDescription) ?></div>
                        </div>

                     <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>