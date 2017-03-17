<?php 

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

$this->beginPage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= Html::encode($this->title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset="UTF-8">
	<?php $this->head(); ?>
</head>
<body>
	<?php $this->beginBody(); ?>
	<section class="head">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<ul class="nav nav-tabs">
						<li role="presentation"><a href="<?= Url::to(['admin/index']); ?>">Главная</a></li>
						<li role="presentation" class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-haspopup="true" aria-expanded="false">Авто <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?= Url::to(['admin/car']); ?>">Все</a></li>
								<li><a href="<?= Url::to(['admin/add-car']); ?>">Добавить</a></li>
							</ul>
					  	</li>
					  	<li role="presentation" class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-haspopup="true" aria-expanded="false">Компании <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?= Url::to(['admin/company']); ?>">Все</a></li>
								<li><a href="<?= Url::to(['admin/add-company']); ?>">Добавить</a></li>
							</ul>
					  	</li>
					  	<li role="presentation"><a href="/">Сайт</a></li>
					</ul>	
				</div>
			</div>
		</div>
	</section>



					<?= $content; ?>



	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>