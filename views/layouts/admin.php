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
	<meta charset="UTF-8">
	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/media.css">
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
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"  role="button" aria-haspopup="true" aria-expanded="false">Добавить <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?= Url::to(['admin/add-car']); ?>">Авто</a></li>
								<li><a href="<?= Url::to(['admin/add-company']); ?>">Марку</a></li>
							</ul>
					  	</li>
					  	<li role="presentation"><a href="#">Messages</a></li>
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