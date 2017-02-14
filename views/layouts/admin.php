<?php 

use app\assets\AppAsset;
AppAsset::register($this);

$this->beginPage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/media.css">
	<?php $this->head(); ?>
</head>
<body>
	<?php $this->beginBody(); ?>
	<?= $content; ?>
	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>