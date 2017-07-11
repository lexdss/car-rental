<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

$loginForm = new app\models\forms\LoginForm();

$this->beginPage();

?>


    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?= Html::encode($this->title); ?></title>

            <?php $this->head(); ?>
        </head>
    <body>
    <?php $this->beginBody(); ?>

    <header>
        <nav class="navbar navbar-default top-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand brand" href="<?= Url::to(['site/index']); ?>"><span>Easy</span>Rent</a>

                    <p class="phone navbar-text visible-md visible-lg">+7 (890) 367-76-86</p>
                    <a href="#" class="callback navbar-text visible-lg">Перезвонить <span class="glyphicon glyphicon-phone"></span></a>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="<?= Url::to(['user/register']); ?>" class="register navbar-text visible-md visible-lg">Регистрация</a>
                    <?php endif; ?>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <?php $form = ActiveForm::begin(['action' => '/login', 'options' => ['class' => 'navbar-form navbar-right']]); ?>

                            <?= $form->field($loginForm, 'email', ['template' => '{input}'])->textInput(['placeholder' => 'E-mail']); ?>
                            <?= $form->field($loginForm, 'password', ['template' => '{input}'])->passwordInput(['placeholder' => 'Пароль']); ?>

                            <a href="<?= Url::to(['user/register']); ?>" class="navbar-text visible-xs">Регистрация</a>
                            <button type="submit" class="btn btn-default">Войти</button>

                        <?php ActiveForm::end(); ?>
                    <?php else: ?>
                        <a href="<?= Url::to(['user/logout']); ?>" class="navbar-text navbar-right">Выход</a>
                        <?php if (Yii::$app->user->identity->role === 'admin'): ?>
                            <a href="<?= Url::to(['admin/admin/index']) ?>" class="navbar-text navbar-right">Администрирование</a>
                        <?php else: ?>
                            <a href="" class="navbar-text navbar-right">Профиль</a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <ul class="nav navbar-nav navbar-right top-menu visible-xs">
                        <li><a href="<?= Url::to(['site/index']); ?>">Главная</a></li>
                        <li><a href="<?= Url::to(['site/news']); ?>">Новости</a></li>
                        <li><a href="#">Бренды</a></li>
                        <li><a href="<?= Url::to(['site/page', 'type' => 'page', 'value' => 'rules']); ?>">Правила</a></li>
                        <li><a href="<?= Url::to(['site/page', 'type' => 'page', 'value' => 'contacts']); ?>">Контакты</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="top-menu">
            <div class="container">
                <ul>
                    <li><a href="<?= Url::to(['site/index']); ?>">Главная</a></li>
                    <li><a href="<?= Url::to(['site/news']); ?>">Новости</a></li>
                    <li><a href="#">Бренды</a></li>
                    <li><a href="<?= Url::to(['site/page', 'type' => 'page', 'value' => 'rules']); ?>">Правила</a></li>
                    <li><a href="<?= Url::to(['site/page', 'type' => 'page', 'value' => 'contacts']); ?>">Контакты</a></li>
                </ul>
                <div class="hr"></div>
            </div>
        </nav>
    </header>

    <div class="container">
        <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]); ?>
    </div>

        <?= $content; ?>

    <footer>
        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-md-6">

                    <ul class="list-unstyled bottom-menu">
                        <li><a href="<?= Url::to(['site/index']); ?>">Главная</a></li>
                        <li><a href="#">Машины</a></li>
                        <li><a href="#">Условия аренды</a></li>
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Пункты проката</a></li>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                    <div class="soc-icons">
                        <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-vk" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a>
                    </div>

                </div>

                <div class="col-sm-12 col-md-6 site-info">

                    <adress>
                        <strong>Наш адрес</strong><br>
                        Россия, Московская обл., г. Москва<br>
                        Улица Льва Мышкина 335 стр. 3<br>
                        Индекс 115093
                    </adress>
                    <div class="phone">
                        0 (800) 749 839 03
                    </div>
                    <p><span class="glyphicon glyphicon-copyright-mark"></span> 2016 Lorem ipsum dolor sit amet, consectetur adipisicing.</p>


                </div>

            </div>
        </div>
    </footer>

    <?php $this->endBody(); ?>
    </body>
    </html>

<?php $this->endPage(); ?>
