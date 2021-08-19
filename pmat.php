<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Партнерская программа</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    <div class="am-mainpanel">
		
		<div class="am-pagetitle">
			<h5 class="am-title">Партнерская программа</h5>
		</div>

		<div class="am-pagebody">       
			<div class="row row-sm">
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						<p class="tx-lato tx-inverse tx-bold">Ваша реф. ссылка: <code class="tx-20">https://realty-money.ru/?ref=<?php echo $ul['id']; ?></code></p>
						
						<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Описание партнерской программы</h6>
						<p class="tx-12 mg-b-15">В партнерской программе может участвовать любой пользователь проекта. Программа предусматривает ряд вознаграждений за определенные действия Ваших рефералов. Рефералы - пользователи, которые зарегистрировались на проекте после перехода по Вашей реферальной ссылке.</p>
						
						<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Вознаграждения</h6>
						<p class="tx-12 mg-b-15">
							- 7% от суммы пополнения реферала 1 уровня<br/>
							- 3% от суммы пополнения реферала 2 уровня<br/>
							- 5% от суммы пополнения рекламного баланса рефералом 1 уровня
						</p>
						
						<h6 class="tx-12 tx-uppercase tx-danger tx-bold mg-b-15">Вознаграждения выплачиваются сразу на Ваш баланс для вывода!</h6>
						
					</div>
				</div>	
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Баннер 468x60</h6>
						<p class="tx-lato tx-inverse tx-bold">
							<img src="https://realty-money.ru/img/banner468x60.gif" style="max-width:468px; width:100%;">
						</p>						
						<p class="tx-12 mg-b-15">Ссылка на банер: <code>https://realty-money.ru/img/banner468x60.gif</code></p>
						
					</div>
				</div>
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Баннер 200x300</h6>
						<p class="tx-lato tx-inverse tx-bold">
							<img src="https://realty-money.ru/img/banner200x300.gif" style="max-width:200px; width:100%;">
						</p>						
						<p class="tx-12 mg-b-15">Ссылка на банер: <code>https://realty-money.ru/img/banner200x300.gif</code></p>
						
					</div>
				</div>
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Баннер 100x100</h6>
						<p class="tx-lato tx-inverse tx-bold">
							<img src="https://realty-money.ru/img/banner100x100.gif" style="max-width:100px; width:100%;">
						</p>						
						<p class="tx-12 mg-b-15">Ссылка на банер: <code>https://realty-money.ru/img/banner100x100.gif</code></p>
						
					</div>
				</div>
				
			</div>       
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
	
</body>
</html>