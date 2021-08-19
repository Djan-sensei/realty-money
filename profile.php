<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `login`, `email`, `ip_reg`, `date_reg`, `date_vh`, `ban`, `money_pok`, `money_viv`, `ref` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
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
	
	$user_mat1 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='1' and `id_users`='".$user['id']."'"));
	$user_mat1d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='1'"));
	$kol_an1 = $user_mat1d['speed']*$user_mat1['kol'];
	
	$user_mat2 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='2' and `id_users`='".$user['id']."'"));
	$user_mat2d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='2'"));
	$kol_an2 = $user_mat2d['speed']*$user_mat2['kol'];
	
	$user_mat3 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='3' and `id_users`='".$user['id']."'"));
	$user_mat3d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='3'"));
	$kol_an3 = $user_mat3d['speed']*$user_mat3['kol'];
	
	$user_mat4 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='4' and `id_users`='".$user['id']."'"));
	$user_mat4d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='4'"));
	$kol_an4 = $user_mat4d['speed']*$user_mat4['kol'];
	
	$user_mat5 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='5' and `id_users`='".$user['id']."'"));
	$user_mat5d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='5'"));
	$kol_an5 = $user_mat5d['speed']*$user_mat5['kol'];
	
	$user_mat6 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='6' and `id_users`='".$user['id']."'"));
	$user_mat6d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='6'"));
	$kol_an6 = $user_mat6d['speed']*$user_mat6['kol'];
	
	$user_mat7 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='7' and `id_users`='".$user['id']."'"));
	$user_mat7d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='7'"));
	$kol_an7 = $user_mat7d['speed']*$user_mat7['kol'];
	
	$user_mat8 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='8' and `id_users`='".$user['id']."'"));
	$user_mat8d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='8'"));
	$kol_an8 = $user_mat8d['speed']*$user_mat8['kol'];
	
	$user_mat9 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='9' and `id_users`='".$user['id']."'"));
	$user_mat9d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='9'"));
	$kol_an9 = $user_mat9d['speed']*$user_mat9['kol'];
	
	$user_mat10 = mysqli_fetch_array(mysqli_query($mysqli, "select `kol` from `users_mat` where `id_mat`='10' and `id_users`='".$user['id']."'"));
	$user_mat10d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='10'"));
	$kol_an10 = $user_mat10d['speed']*$user_mat10['kol'];
	
	$prib = $kol_an1 + $kol_an2 + $kol_an3 + $kol_an4 + $kol_an5 + $kol_an6 + $kol_an7 + $kol_an8 + $kol_an9 + $kol_an10;
	
	// Кол-во рефералов 1 уровная
	$user_ref = mysqli_fetch_array(mysqli_query($mysqli, "select COUNT(*) as `count` from `users` where `ref`='".$user['id']."'"));
	
	// Кол-во рефералов 2 уровная
	$sql_kol_ref2 = mysqli_query($mysqli, "SELECT `id` FROM `users` WHERE `ref`='".$user['id']."'");
	while($row_kol_ref2 = mysqli_fetch_assoc($sql_kol_ref2)) {
		$user_ref2c = mysqli_fetch_array(mysqli_query($mysqli, "select COUNT(*) as `count` from `users` where `ref`='".$row_kol_ref2['id']."'"));
		$user_ref2 += $user_ref2c['count'];
	}
	
	// Общее кол-во рефералов
	$ref_all = $user_ref['count'] + $user_ref2;
		
	// Кол-во недвижимости
	$user_ned = mysqli_fetch_array(mysqli_query($mysqli, "select SUM(`kol`) as `sum` from `users_mat` where `id_users`='".$user['id']."'"));
		
	// Кол-во сделанных кликов в серфинге
	$user_serfCl = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(*) as `count` FROM `serf_users` WHERE `id_users`='".$user['id']."' and `yes`='1'"));
	
	// Заработано на серфинге
	$user_serfSum = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(`price`) as `sum` FROM `serf_users` WHERE `id_users`='".$user['id']."' and `yes`='1'"));
	
	// Заработано на рефералах
	$user_refSum = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(`money`) as `sum` FROM `dvizh` WHERE `id_users`='".$user['id']."'"));
	
	// Выплачено
	$user_viv = mysqli_fetch_array(mysqli_query($mysqli, "select SUM(`money`) as `sum` from `users_vivod` where `id_users`='".$user['id']."'"));
	
	// Пополнено
	$user_pop = mysqli_fetch_array(mysqli_query($mysqli, "select SUM(`money`) as `sum` from `users_money` where `id_users`='".$user['id']."'"));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Профиль</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    

    <div class="am-mainpanel">
		<div class="am-pagetitle">
			<h5 class="am-title">Профиль</h5>
		</div>

		<div class="am-pagebody">
		
			<div class="row row-sm">
			
				<div class="col-lg-3">
					<div class="card">
						<div class="wd-100p ht-160"></div>
						<div class="overlay-body pd-x-20 pd-t-20">
							<div class="d-flex justify-content-between">
								<div>
									<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">Прибыль</h6>
									<p class="tx-12">на <?php echo date('d.m.Y'); ?></p>
								</div>
							</div>
							<h2 class="mg-b-5 tx-inverse tx-lato"><?php echo $prib; ?> Р</h2>
							<p class="tx-12 mg-b-0">Сбор прибыли (руб.) в час</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3">
					<div class="card">
						<div class="wd-100p ht-160"></div>
						<div class="overlay-body pd-x-20 pd-t-20">
							<div class="d-flex justify-content-between">
								<div>
									<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">Рефералов</h6>
									<p class="tx-12">на <?php echo date('d.m.Y'); ?></p>
								</div>
							</div>
							<h2 class="mg-b-5 tx-inverse tx-lato"><?php echo $ref_all; ?> чел.</h2>
							<p class="tx-12 mg-b-0">Кол-во Ваших рефералов</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3">
					<div class="card">
						<div class="wd-100p ht-160"></div>
						<div class="overlay-body pd-x-20 pd-t-20">
							<div class="d-flex justify-content-between">
								<div>
									<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">Выплачено</h6>
									<p class="tx-12">на <?php echo date('d.m.Y'); ?></p>
								</div>
							</div>
							<h2 class="mg-b-5 tx-inverse tx-lato"><?php echo 0+$user_viv['sum']; ?> Р</h2>
							<p class="tx-12 mg-b-0">Выплачено руб. на кошелек</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-3">
					<div class="card">
						<div class="wd-100p ht-160"></div>
						<div class="overlay-body pd-x-20 pd-t-20">
							<div class="d-flex justify-content-between">
								<div>
									<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">Серфинг</h6>
									<p class="tx-12">на <?php echo date('d.m.Y'); ?></p>
								</div>
							</div>
							<h2 class="mg-b-5 tx-inverse tx-lato"><?php echo 0+$user_serfCl['count'];?> шт.</h2>
							<p class="tx-12 mg-b-0">Кол-во сделанных кликов</p>
						</div>
					</div>
				</div>
				
			</div>

			<div class="row row-sm mg-t-15 mg-sm-t-20">
				<div class="col-md-6">
					<div class="card pd-20 pd-sm-40">
						<h6 class="card-body-title">Данные аккаунта</h6>
						<p class="mg-b-20 mg-sm-b-30">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>Ваш ID</th>
										<td><?php echo $user['id']; ?></td>
									</tr>
									<tr>
										<th>Логин</th>
										<td><?php echo $user['login']; ?></td>
									</tr>
									<tr>
										<th>Почта</th>
										<td><?php echo $user['email']; ?></td>
									</tr>
									<tr>
										<td>IP регистрации</td>
										<td><?php echo $user['ip_reg']; ?></td>
									</tr>
									<tr>
										<td>Дата регистрации</td>
										<td><?php echo date_format(date_create($user['date_reg']), 'd.m.Y в H:i'); ?></td>
									</tr>
									<tr>
										<td>Последний раз был</td>
										<td><?php echo date_format(date_create($user['date_vh']), 'd.m.Y в H:i'); ?></td>
									</tr>
									<tr>
										<th>Вас пригласил</th>
										<td><?php 
											$user_prig = mysqli_fetch_array(mysqli_query($mysqli, "select `login` from `users` where `id`='".$user['ref']."'"));
											if($user_prig['login']) { echo $user_prig['login']; }
											else { echo 'пришел сам'; }
										?></td>
									</tr>
								</tbody>
							</table>
						</p>
					</div>
				</div>
				<div class="col-md-6 mg-t-15 mg-sm-t-20 mg-md-t-0">
					<div class="card pd-20 pd-sm-40">
						<h6 class="card-body-title">Статистика аккаунта</h6>
						<p class="mg-b-20 mg-sm-b-30">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>Сумма пополнений</th>
										<td><?php echo 0+$user_pop['sum']; ?> руб.</td>
									</tr>
									<tr>
										<th>Сумма выплат</th>
										<td><?php echo 0+$user_viv['sum']; ?> руб.</td>
									</tr>
									<tr>
										<th>Доход с рефералов</th>
										<td><?php echo number_format($user_refSum['sum'], 4, '.', ' ');?> руб.</td>
									</tr>
									<tr>
										<th>Сделано кликов</th>
										<td><?php echo 0+$user_serfCl['count'];?></td>
									</tr>
									<tr>
										<th>Заработано на серфинге</th>
										<td><?php echo number_format($user_serfSum['sum'], 4, '.', ' ');?> руб.</td>
									</tr>
									<tr>
										<th>Кол-во рефералов</th>
										<td><?php echo $ref_all; ?> чел.</td>
									</tr>
									<tr>
										<th>Недвижимости</th>
										<td><?php echo $user_ned['sum']; ?> шт.</td>
									</tr>
								</tbody>
							</table>
						</p>
					</div>
				</div>
			</div>

        
		</div>
		
		<div class="am-footer">
			<span>Copyrights ©2018 realty-money.ru All rights reserved.</span>
			<span><a href="terms.php">Правила проекта</a></span>
		</div>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>