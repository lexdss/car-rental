<?php
/**
 * Main page
 *
 * @var $companies \app\models\Company[]
 * @var $categories \app\models\Category[]
 */

use app\widgets\CarsBlock\CarsBlock;
use yii\helpers\Url;

$this->title = 'Главная страница';
?>

<section class="order">
    <div class="container">
        <div class="row">
            <div class="order-info">

                <form action="">

                    <div class="row">
                        <div class="col-xs-12 col-md-5">
                            <div class="form-group">
                                <select name="" class="form-control">
                                    <option value="">Модель автомобиля</option>
                                    <option value="">Hyundai Solaris AT NEW</option>
                                    <option value="">Hyundai Creta AT NEW</option>
                                    <option value="">Hyundai H1 AT</option>
                                    <option value="">KIA Quoris AT</option>
                                    <option value="">Hyundai Genesis V6 4 W</option>
                                    <option value="">Mercedes-Benz E 200 AM</option>
                                    <option value="">Hyundai Equus AT</option>
                                    <option value="">KIA Sorento AT 4WD</option>
                                    <option value="">Renault Duster MT 4WD</option>
                                    <option value="">Hyundai Creta AT NEW</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="" class="form-control">
                                    <option value="">Выберите удобное место получения автомобиля</option>
                                    <option value="">ул. Павлова 37б к.2</option>
                                    <option value="">ул. Кленовая 74-а</option>
                                    <option value="">Проспект Ленинский 29</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input type="checkbox" name="save" value="1"> Страховка
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="radio-inline">
                                            <input type="checkbox" name="driver" value="2"> Водитель
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" required placeholder="Имя">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" required placeholder="Телефон">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" required placeholder="E-mail">
                            </div>

                            <p><strong>Начало проката</strong>: <i class="fa fa-calendar s-calendar calendar" aria-hidden="true"></i></p>

                            <p><strong>Конец проката</strong>: <i class="fa fa-calendar f-calendar calendar" aria-hidden="true"></i></p>

                            <button class="btn btn-primary btn-lg center-block order-btn">Заказать</button>

                        </div>

                        <div class="col-xs-12 col-md-7 site-info">
                            <h1>О компании</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quae quidem error sint pariatur, inventore voluptatibus nobis exercitationem architecto sunt, fugit. Minima cum totam odit tempore voluptatum aliquid distinctio voluptates veniam, iste magni veritatis culpa maxime velit dignissimos doloribus tenetur error suscipit sed illum magnam quas id ratione. Velit porro fugiat dicta iure sequi quisquam rem voluptatum corporis adipisci a sit laboriosam ipsum accusantium repellendus sapiente, dolore earum at eligendi incidunt, quae accusamus illum, nisi quasi. Sint hic facilis nemo porro, possimus beatae, amet dolorem officia nam laudantium quae repellendus ducimus voluptas blanditiis aperiam voluptatibus numquam corporis maiores. Porro, repellat.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, itaque harum ipsum voluptates earum reprehenderit ipsa, molestias repudiandae architecto asperiores, doloribus vitae aliquid praesentium officiis labore voluptatum doloremque ea quis recusandae eius eaque quidem quo. Debitis hic, quidem, id nesciunt sunt repellendus laboriosam porro praesentium cumque provident, quam eligendi quisquam necessitatibus temporibus beatae quas. Reiciendis corporis velit rem hic architecto, voluptas, pariatur odit beatae assumenda accusantium blanditiis harum dolorum iure!</p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<?php if ($categories): ?>
    <section class="selection">
        <div class="container">
            <div class="row">
                <div class="category">

                        <?php foreach ($categories as $category): ?>

                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href=""><img src="<?= $category->img ?>" class="img-response"></a>
                                <h4><a href="<?= Url::to(['site/category', 'value' => $category->slug])?>"><?= $category->name ?></a></h4>
                                <p class="text-justify"><?= $category->short_description ?></p>
                            </div>

                        <?php endforeach; ?>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<h2 class="text-center">Популярные предложения</h2>
<?= CarsBlock::widget(); ?>

<section class="advantages">
    <div class="container">
        <div class="row">
            <h2 class="text-center mb20">Наши преимущества</h2>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <img src="img/price.png" alt="" class="img-response">
                    <h4>Выгодные цены</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <img src="img/24-hours.png" alt="" class="img-response">
                    <h4>Круглосуточная работа</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <img src="img/client.png" alt="" class="img-response">
                    <h4>Скидки для постоянных клиентов</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <img src="img/auto.png" alt="" class="img-response">
                    <h4>Большой выбор авто</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <img src="img/professional.png" alt="" class="img-response">
                    <h4>Профессиональные сотрудники</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="advantages-item">
                    <img src="img/fast.png" alt="" class="img-response">
                    <h4>Быстрое обслуживание</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe suscipit quis ad placeat temporibus, blanditiis est perferendis similique architecto odio earum, ut aliquam voluptates at corporis soluta ipsum itaque voluptatem!
                </div>
            </div>
        </div>
    </div>
</section>

<section class="brand">
    <div class="container">
        <div class="row">
            <div class="brand-list">

                <?php if($companies): ?>
                    <?php foreach($companies as $company): ?>
                        <div class="brand-item">
                            <a href="<?= Url::to(['site/company', 'value' => $company->slug]) ?>">
                                <div class="brand-desc">
                                    <div class="brand-name">
                                        <?= $company->name ?>
                                    </div>
                                </div>
                                <img src="<?= $company->img ?>" class="img-response">
                            </a>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>

            </div>

        </div>
    </div>
</section>