<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban`, `money_pok` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
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
	
	$r_rulbank_proi = mysqli_query($mysqli, "select sum(`money`) as `sum` from `ruletka_bank` where `result` = '0'");
	$a_rulbank_proi = mysqli_fetch_array($r_rulbank_proi);

	$r_rulbank_pob = mysqli_query($mysqli, "select sum(`money`) as `sum` from `ruletka_bank` where `result` = '1'");
	$a_rulbank_pob = mysqli_fetch_array($r_rulbank_pob);

	$bank = round($a_rulbank_proi['sum'] - $a_rulbank_pob['sum']);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Рулетка</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    

    <div class="am-mainpanel">
		<div class="am-pagetitle">
			<h5 class="am-title">Попытай удачу</h5>
		</div>

		<div class="am-pagebody">
		
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card pd-20">
					
						<?php if($user['id'] == 1) {
							echo '<p class="mg-b-20 mg-sm-b-30">Проигрыши на сумму: <code>'.$a_rulbank_proi['sum'].'</code><br>Победы на сумму: <code>'.$a_rulbank_pob['sum'].'</code><br>Общий банк: <code>'.$bank.'</code></p>';
						} ?>
						
						<p class="mg-b-20 mg-sm-b-30">Беспроигрышная рулетка, попытайте свою удачу и выиграйте одну из построек 100%. Сумма списывается с баланса для покупок.</p>
						<iframe name="Frame" style="display:none;"></iframe>
						<form accept-charset="utf-8" action="" method="post" target="Frame">
							<div class="row mg-b-25">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label">Сумма ставки, мин. 12 руб.: <span class="tx-danger">*</span></label>
										<input class="form-control" type="number" name="stavka" value="" placeholder="Сумма ставки, мин. 12 руб.">
									</div>
								</div>
							</div>
							<div class="form-layout-footer">									
								<input type="submit" class="btn btn-success" name="stav" value="Попытать удачу" />
								<?php
							if(isset($_POST['stav'])) {
								
								$stavka = mysqli_real_escape_string($mysqli, $_POST['stavka']);
								$stavka = strip_tags($stavka);
								$stavka = htmlspecialchars($stavka);
								$stavka = (int)$stavka;
								
								if($user['money_pok'] >= $stavka and $stavka >= 12) {
									
									$sqlpok1 = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`=`money_pok`-'".$stavka."' WHERE `id`='".$user['id']."'");
									
									//$stavka = round($stavka - ($stavka*0.2));
									
									$bank = $bank + $stavka;
									
									if($bank <= 50) {
										$x_rand = 1;
									} else if($bank > 50 and $bank <= 250) {
										$x_rand = rand(1,2);
									} else if($bank > 250 and $bank <= 1000) {
										$x_rand = rand(1,3);									
									} else if($bank > 1000 and $bank <= 3200) {
										$x_rand = rand(1,4);
									} else if($bank > 3200 and $bank <= 5200) {
										$x_rand = rand(1,5);
									} else if($bank > 5200 and $bank <= 8000) {
										$x_rand = rand(1,6);
									} else if($bank > 8000 and $bank <= 12800) {
										$x_rand = rand(1,7);
									} else if($bank > 12800 and $bank <= 22000) {
										$x_rand = rand(1,8);
									} else if($bank > 22000 and $bank <= 52000) {
										$x_rand = rand(1,9);
									} else if($bank > 52000) {
										$x_rand = rand(1,10);
									}

									$pri = mysqli_fetch_array(mysqli_query($mysqli, "select `name`, `price` from `mat` where `id`='".$x_rand."'"));
									$nam = $pri['name'];
									$sum_min = $pri['price'];
									
									$sqlst1 = mysqli_query($mysqli, "INSERT INTO `ruletka_bank`(`id_users`, `money`, `result`, `date`) VALUES ('".$user['id']."', '".$stavka."', '0', '". date("Y-m-d H:i:s") ."')");
									$sqlst2 = mysqli_query($mysqli, "INSERT INTO `ruletka_bank`(`id_users`, `money`, `result`, `date`, `priz`) VALUES ('".$user['id']."', '".$sum_min."', '1', '". date("Y-m-d H:i:s") ."', '".$x_rand."')");
									
									$usmat = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `id_mat` from `users_mat` where `id_users`='".$user['id']."' and `id_mat`='".$x_rand."'"));
									if($usmat['id']) {
										$sql_day_bk_an1 = mysqli_query($mysqli, "UPDATE `users_mat` SET `kol`=`kol`+1, `start`='". date('Y-m-d H:i:s') ."' WHERE `id_users`='".$user['id']."' and `id_mat`='".$usmat['id_mat']."'");
									} else {
										$sql_day_bk_an1 = mysqli_query($mysqli, "INSERT INTO `users_mat`(`id_users`, `id_mat`, `kol`, `start`) VALUES ('".$user['id']."', '".$x_rand."', '1', '". date("Y-m-d H:i:s") ."')");
									}
									
									echo '<script type="text/javascript"> top.alert("Вы выиграли: '.$nam.'!"); top.window.location.href="ruletka.php"; </script>';
								} else {
									echo '<script type="text/javascript"> top.alert("Не хватает денег!"); top.window.location.href="ruletka.php"; </script>';
								}
							}
						?>
							</div> 
						</form>							
				</div>
				</div>
			</div>
			
			<div class="row row-sm mg-t-15 mg-sm-t-20">
				<div class="col-md-12">
					<div class="card pd-20 pd-sm-40">
						<h6 class="card-body-title">Последние 10 полученных призов</h6>
						<p class="mg-b-20 mg-sm-b-30">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>Логин</th>
										<th>Что получил</th>
										<th>Когда получил</th>
									</tr>
									<?php
										$sql_n = mysqli_query($mysqli, "SELECT `id_users`, `priz`, `date` FROM `ruletka_bank` WHERE `result`='1' ORDER by `date` DESC LIMIT 0,10");
										while($row_n = mysqli_fetch_assoc($sql_n)) {
											$user_l = mysqli_fetch_array(mysqli_query($mysqli, "select `login` from `users` where `id`='".$row_n['id_users']."'"));
											$priz_l = mysqli_fetch_array(mysqli_query($mysqli, "select `name` from `mat` where `id`='".$row_n['priz']."'"));
									?>	
											<tr>
												<td><?php echo $user_l['login'];?></td>
												<td><?php echo $priz_l['name'];?></td>
												<td><?php echo date_format(date_create($row_n['date']), 'd.m.Y в H:i');?></td>
											</tr>
									<?php } ?>
								</tbody>
							</table>
						</p>
					</div>
				</div>
			</div>

        
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>