<?php 

	use yii\helpers\Url;	

?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li><a href="<?= Url::to(['index']); ?>">Главная</a></li>
					<li class="active">Бизнес класс</li>
				</ol>
			</div>
		</div>
	</div>
</section>
	
<section class="car-list">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Бизнес класс</h2>
			
			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>Модель</th>
							<th class="year">Год выпуска</th>
							<th>Цена</th>
						</tr>
					</thead>
					<tr>
						<td>
							<img src="img/popular-1.jpg" alt="" class="img-responsive">
						</td>
						<td><a href="">BMW 5er VI</a></td>
						<td class="year">2010</td>
						<td>1500 руб/день</td>
						<td><button class="btn btn-success">Заказать</button></td>
					</tr>
					<tr>
						<td><img src="img/popular-2.jpg" alt="" class="img-responsive"></td>
						<td><a href="">Hyundai ix55</a></td>
						<td class="year">2007</td>
						<td>1000 руб/день</td>
						<td><button class="btn btn-success">Заказать</button></td>
					</tr>
					<tr>
						<td><img src="img/popular-3.jpg" alt="" class="img-responsive"></td>
						<td><a href="">Audi A5 I</a></td>
						<td class="year">2012</td>
						<td>1700 руб/день</td>
						<td><button class="btn btn-success">Заказать</button></td>
					</tr>
					<tr>
						<td><img src="img/popular-4.jpg" alt="" class="img-responsive"></td>
						<td><a href="">Chevrolet Lacetti</a></td>
						<td class="year">2000</td>
						<td>1100 руб/день</td>
						<td><button class="btn btn-success">Заказать</button></td>
					</tr>
				</table>
			</div>
			
			<div class="col-xs-12">
			<p>
				<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor in saepe consequuntur voluptatibus magnam aperiam illo ipsum. Iure quod, enim deserunt minus laboriosam a error. Animi ipsam dolore repudiandae natus.</span>
				<span>Maiores quos dolore odit obcaecati saepe aliquid animi repellendus molestiae reiciendis eaque officiis expedita blanditiis eum distinctio et, ab sit in? Rem odit reprehenderit blanditiis, praesentium quidem inventore illo distinctio.</span>
				<span>Neque earum enim voluptatum, iste quae, porro qui, exercitationem alias dolorem placeat non magnam quam minima. Optio qui eveniet eligendi, inventore sed illum cupiditate tenetur ea sit odio et neque.</span>
			</p>
			</div>
		</div>
	</div>
</section>