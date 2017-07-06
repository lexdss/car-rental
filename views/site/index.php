<?php
/**
 * Main page
 *
 * @var $companies \app\models\Company[]
 * @var $categories \app\models\Category[]
 */

use app\widgets\CarsBlock\CarsBlock;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Главная страница';

?>

<section class="slider">
    <div class="container-fluid">

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="img/slider/1.jpg">
                    <div class="carousel-caption">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente consequuntur cum nobis nihil officiis accusantium, tenetur sed assumenda ipsam dolorem molestias, minima animi mollitia natus fugiat reiciendis cupiditate, ipsum nam.
                    </div>
                </div>
                <div class="item">
                    <img src="img/slider/2.jpg">
                    <div class="carousel-caption">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente consequuntur cum nobis nihil officiis accusantium, tenetur sed assumenda ipsam dolorem molestias, minima animi mollitia natus fugiat reiciendis cupiditate, ipsum nam.
                    </div>
                </div>
                <div class="item">
                    <img src="img/slider/3.jpg">
                    <div class="carousel-caption">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente consequuntur cum nobis nihil officiis accusantium, tenetur sed assumenda ipsam dolorem molestias, minima animi mollitia natus fugiat reiciendis cupiditate, ipsum nam.
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Предыдущая</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Следующая</span>
            </a>
        </div>

    </div>
</section>

<section class="main-info">
    <div class="container-fluid">
        <div class="row info-part">
            <div class="col-xs-12 col-sm-8 about">
                <h1>О компании</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam maiores ea officia dignissimos asperiores, tenetur sunt quod minus, id illo obcaecati saepe recusandae deleniti quia labore praesentium ipsum, sint ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam maiores ea officia dignissimos asperiores, tenetur sunt quod minus, id illo obcaecati saepe recusandae deleniti quia labore praesentium ipsum, sint ad!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam maiores ea officia dignissimos asperiores, tenetur sunt quod minus, id illo obcaecati saepe recusandae deleniti quia labore praesentium ipsum, sint ad!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est asperiores modi laboriosam consectetur vero ex assumenda autem dolores voluptatum, illo quod voluptate labore eaque error aut suscipit minima fugit consequatur. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore vel qui necessitatibus aspernatur. Incidunt eligendi nobis odio vitae quibusdam iste dolores necessitatibus suscipit sunt dicta, reiciendis libero ipsum aspernatur consectetur.</p>
            </div>

            <div class="col-xs-12 col-sm-4 news">
                <h3><a href="">Новости</a></h3>
                <div class="hr"></div>
                <p>
                    <span><em>14.07.2015</em></span><br>
                    <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere vitae, ab quibusdam.</a>
                </p>
                <p>
                    <span><em>09.12.2015</em></span><br>
                    <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam dicta, illo expedita dolorem, numquam id?</a>
                </p>
                <p>
                    <span><em>12.10.2015</em></span><br>
                    <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, deserunt.</a>
                </p>
                <p>
                    <span><em>14.07.2015</em></span><br>
                    <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque suscipit esse quo praesentium?</a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php if ($categories): ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Наши предложения</h2>
            <div class="row categories-container">
                <?php foreach ($categories as $category): ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <figure class="item-category">
                            <img src="<?= $category->img; ?>" class="img-responsive center-block">
                            <h3><a href="<?= Url::to(['site/category', 'value' => $category->slug]); ?>"><?= Html::encode($category->name); ?></a></h3>
                            <figcaption><?= $category->short_description; ?></figcaption>
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($companies): ?>
    <section class="brand">
        <div class="container">
            <div class="row">
                <div class="brand-list">
                    <?php foreach($companies as $company): ?>
                        <div class="brand-item">
                            <a href="<?= Url::to(['site/company', 'value' => $company->slug]); ?>">
                                <div class="brand-desc">
                                    <div class="brand-name">
                                        <?= Html::encode($company->name); ?>
                                    </div>
                                </div>
                                <img src="<?= Html::encode($company->img); ?>" class="img-response">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam eligendi optio, temporibus illum dolorum facere officia magni earum nostrum, debitis animi ullam reprehenderit molestias ratione deserunt quaerat voluptate, consectetur autem.</span>
                <span>Quam ducimus omnis deserunt rerum, reprehenderit doloremque nostrum cupiditate vero, magnam minus vel eum doloribus quos dignissimos quod, voluptatum eaque quia cum vitae ad sit. Dolores numquam explicabo doloremque nostrum!</span>
                <span>Aut saepe minima, magni doloremque, omnis velit illum reiciendis voluptatem consequatur sequi. Voluptate ad accusamus impedit inventore libero vel, eos! Voluptas vero perspiciatis impedit iste eius, tenetur, quas obcaecati dolorum.</span></p>
        </div>
    </section>
<?php endif; ?>

<section class="car-list">
    <div class="container">
        <h2 class="text-center">Популярные предложения</h2>
        <?= CarsBlock::widget(); ?>
    </div>
</section>

<section class="advantages">
    <div class="container">
        <h2 class="text-center">Наши преимущества</h2>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <span class="glyphicon glyphicon-usd"></span>
                    <h4>Выгодные цены</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <span class="glyphicon glyphicon-time"></span>
                    <h4>Круглосуточная работа</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    <h4>Скидки для постоянных клиентов</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <span class="glyphicon glyphicon-thumbs-up"></span>
                    <h4>Большой выбор авто</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    <h4>Профессиональные сотрудники</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <span class="glyphicon glyphicon-forward"></span>
                    <h4>Быстрое обслуживание</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
        </div>
    </div>
</section>