<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Калькулятор прибыли</title>
	<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="css/amanda.css">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>    
	<div class="am-signup-wrapper" style="background:url('img/fon.jpg'); background-attachment:fixed;">
		<div class="am-signup-box">
			<div class="row no-gutters">
				<div class="col-lg-12">
					<div>
						<h2><a href="/">RealtyMoney</a> - Калькулятор прибыли</h2>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
					
						
					
						<div class="col-lg-12 mg-sm-t-10" align="center">
							<p class="pd-20">Калькулятор дохода служит для расчета Вашей прибыли от недвижимости. <b>Калькулятор не учитывает возможные бонусы, серфинг, ускорения заработка, а так же реферальные вознаграждения</b>. Калькулятор считает только доход за час, сутки, месяц, год и чистую прибыль за год, согласно скорости заработка каждой постройки.</p>
						</div>
						
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Садовый домик</h6>
									<input class="form-control" id="kol_1" value="0" type="number">
									<input id="speed_1" value="0.0034" type="hidden">
									<input id="price_1" value="10" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Дачный дом</h6>
									<input class="form-control" id="kol_2" value="0" type="number">
									<input id="speed_2" value="0.018" type="hidden">
									<input id="price_2" value="50" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Коттедж</h6>
									<input class="form-control" id="kol_3" value="0" type="number">
									<input id="speed_3" value="0.093" type="hidden">
									<input id="price_3" value="250" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Усадьба</h6>
									<input class="form-control" id="kol_4" value="0" type="number">
									<input id="speed_4" value="0.38" type="hidden">
									<input id="price_4" value="1000" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Почтамт</h6>
									<input class="form-control" id="kol_5" value="0" type="number">
									<input id="speed_5" value="1.2" type="hidden">
									<input id="price_5" value="3000" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Офисное здание</h6>
									<input class="form-control" id="kol_6" value="0" type="number">
									<input id="speed_6" value="2.12" type="hidden">
									<input id="price_6" value="5000" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Больница</h6>
									<input class="form-control" id="kol_7" value="0" type="number">
									<input id="speed_7" value="3.22" type="hidden">
									<input id="price_7" value="7500" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Производство</h6>
									<input class="form-control" id="kol_8" value="0" type="number">
									<input id="speed_8" value="5.55" type="hidden">
									<input id="price_8" value="12500" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Банк</h6>
									<input class="form-control" id="kol_9" value="0" type="number">
									<input id="speed_9" value="9.16" type="hidden">
									<input id="price_9" value="20000" type="hidden">
								</div>
							</div>			  
									
							<div class="col-lg-4 mg-t-15 mg-sm-t-20">
								<div class="card">
									<h6 class="tx-inverse tx-14">Высотка</h6>
									<input class="form-control" id="kol_10" value="0" type="number">
									<input id="speed_10" value="24.3" type="hidden">
									<input id="price_10" value="50000" type="hidden">
								</div>
							</div>			  
												
						<div class="col-lg-12 mg-t-15 mg-sm-t-20" align="center">
							<button class="btn btn-info" onclick="sums();">Рассчитать прибыль</button>
						</div>
						
						<div class="pd-20">
							<table class="table table-bordered">
								<tbody><tr>
									<th>Доход за 1 час:</th>
									<td><span id="d1"></span> руб.</td>
								</tr>
								<tr>
									<th>Доход за 24 часа:</th>
									<td><span id="d2"></span> руб.</td>
								</tr>
								<tr>
									<th>Доход за 30 дней:</th>
									<td><span id="d3"></span> руб.</td>
								</tr>
							</tbody></table>
							
							<table class="table table-bordered">
								<tbody><tr>
									<th>Затраты:</th>
									<td><span id="d5"></span> руб.</td>
								</tr>
								<tr>
									<th>Доход за 365 дней:</th>
									<td><span id="d4"></span> руб.</td>
								</tr>
								<tr>
									<th>Чистая прибыль за 365 дней:</th>
									<td><span id="d6"></span> руб.</td>
								</tr>
							</tbody></table>
						</div>
						
					
						
					</div>
				</div>
			</div>			
			<p class="tx-center tx-white-5 tx-12 mg-t-15">
				Copyrights ©2018 realty-money.ru All rights reserved. <a href="terms.php">Правила проекта</a>.
			</p>
		</div>
	</div>	
    <script src="lib/jquery/jquery.js"></script>
    <script src="lib/popper.js/popper.js"></script>
    <script src="lib/bootstrap/bootstrap.js"></script>
    <script src="lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="js/amanda.js"></script>
	
	<script>
		function sums() {
			var sum = 0, price = 0;

			for(var i = 1; i <= 10; i++) {
				
				sum += $('#kol_'+i).val() * $('#speed_'+i).val();
				price += $('#kol_'+i).val() * $('#price_'+i).val();
				
				$('#d1').html( sum.toFixed(4) );
				$('#d2').html( (sum*24).toFixed(2) );
				$('#d3').html( (sum*720).toFixed(2) );
				$('#d4').html( (sum*8760).toFixed(2) );
				$('#d5').html( (price).toFixed(2) );
				$('#d6').html( (sum*8760 - price).toFixed(2) );
			}
		}
	</script>
	
  </body>
</html>