<?php

	use app\assets\AppAsset;
	use yii\helpers\Html;

	AppAsset::register($this);

	$this->beginPage(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= Html::encode($this->title); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Exo|Noto+Sans" rel="stylesheet"> 
	<?php $this->head(); ?>
</head>
<body>
	<?php $this->beginBody(); ?>

	<header>
		<nav class="navbar top-navbar">
			<div class="container">
				<div class="row">
					
					<div class="navbar-header">
						<a href="" class="navbar-brand logo"><span>Rent</span>Car</a>
						<button class="navbar-toggle collapsed btn-hamburger" data-toggle="collapse" data-target="#top-menu">
							<span class="glyphicon glyphicon-menu-hamburger"></span>
						</button>
					</div>

					<div class="navbar-collapse collapse" id="top-menu">
						<ul class="list-inline navbar-right">
							<a href="#"><li>Главная</li></a>
							<a href="#"><li>Машины</li></a>
							<a href="#"><li>Условия аренды</li></a>
							<a href="#"><li>О компании</li></a>
							<a href="#"><li>Пункты проката</li></a>
							<a href="#"><li>Контакты</li></a>
						</ul>
					</div>

				</div>
			</div>
		</nav>
		<div class="container">
			<div class="row">
				<div class="header-img"></div>
			</div>
		</div>
	</header>

	<?= $content; ?>

	<footer>
		<div class="container">
			<div class="row">

				<div class="col-sm-12 col-md-6">
					
					<ul class="list-unstyled bottom-menu">
						<li><a href="#">Главная</a></li>
						<li><a href="#">Машины</a></li>
						<li><a href="#">Условия аренды</a></li>
						<li><a href="#">О компании</a></li>
						<li><a href="#">Пункты проката</a></li>
						<li><a href="#">Контакты</a></li>
					</ul>
					<div class="soc-icons">
						<a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
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
					<p><i class="fa fa-copyright" aria-hidden="true"></i> 2016 Lorem ipsum dolor sit amet, consectetur adipisicing.</p>


				</div>

			</div>
		</div>
	</footer>
	
	<?php $this->endBody(); ?>
</body>
</html>

<?php $this->endPage(); ?>