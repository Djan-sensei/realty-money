<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `login`, `ban` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
	// Если пользователь не авторизирован
	if(!$user['id']) {
		echo '<script type="text/javascript"> window.location.href="/"; </script>';
		exit;
	}

	// Если пользователь забанен
	if($user['ban'] == '1') {
		echo '<script type="text/javascript"> window.location.href="/ban_page.php"; </script>';
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Пополнение баланса</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    

    <div class="am-mainpanel">
		<div class="am-pagetitle">
			<h5 class="am-title">Пополнение баланса</h5>
		</div>

		<div class="am-pagebody">
		
			<div class="row row-sm">
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						
						<p class="mg-b-15">
							Получайте бонус к пополнению!<br>
							от 500 руб. - <code><b>3%</b> от суммы пополнения</code><br/>
							от 1000 руб. - <code><b>5%</b> от суммы пополнения</code><br/>
							от 5000 руб. - <code><b>7%</b> от суммы пополнения</code><br/>
							от 10000 руб. - <code><b>10%</b> от суммы пополнения</code>
						</p>
						
					</div>
				</div>	
			
				<div class="col-lg-6">
					<div class="card">
						<div class="wd-100p ht-250"></div>
						<div class="overlay-body pd-x-20 pd-t-20">
							<div class="d-flex justify-content-between">
								<div>
									<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">Пополнить через Payeer</h6>
								</div>
							</div>
							<p class="tx-12 mg-b-0">
								<form method="GET" action="payeer_get.php">
									<input type="number" id="p_money" name="p_money" class="form-control" value="100"><br>
									<input type="submit" class="btn btn-info" name="m_process" style="margin:0 auto; cursor:pointer;" value="Пополнить баланс">
								</form>							
							</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-6">
					<div class="card">
						<div class="wd-100p ht-250"></div>
						<div class="overlay-body pd-x-20 pd-t-20">
							<div class="d-flex justify-content-between">
								<div>
									<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">Пополнить через Яндекс.Деньги</h6>
								</div>
							</div>
							<p class="tx-12 mg-b-0">
								<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
									<div>
										<input type="text" id="sum" name="sum" class="form-control" value="100">
									</div>
									<br>
									<div>
										<label for="" class="control-label">Способ оплаты</label>
										<div class="tabular-border">
											<select name="paymentType" class="form-control">
												<option value="PC">Яндекс Деньги</option>
												<option value="AC">Банковская карт</option>
											</select>
										</div>
									</div>
									<br>
									<div>										
										<input type="hidden" name="receiver" value="**************">
										<input type="hidden" name="formcomment" value="Пополнение баланса, пользователь <?php echo $user['login']; ?> (ID <?php echo $user['id']; ?>)">
										<input type="hidden" name="label" value="<?php echo strval($user['id']); ?>">
										<input type="hidden" name="quickpay-form" value="shop">
										<input type="hidden" name="targets" value="Пополнение баланса, пользователь <?php echo $user['login']; ?> (ID <?php echo $user['id']; ?>)">
										<input type="hidden" name="successURL" value="https://realty-money.ru/success.html">
										<input type="submit" class="btn btn-success" name="submit-button"  value="Пополнить баланс">
									</div>
								</form>
							</p>
						</div>
					</div>
				</div>
				
			</div>
        
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>