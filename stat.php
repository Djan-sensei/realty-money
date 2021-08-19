<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Статистика проекта</title>
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
						<h2><a href="/">RealtyMoney</a> - Статистика</h2>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-12 mg-b-20">
							<div class="row">
								<div class="col-lg-6">
									<table class="table table-bordered">
										<tr><td>Открытие</td></tr>
										<tr>
											<th style="text-align:center">02.03.2018</th>
										</tr>
									</table>
								</div>
								<div class="col-lg-6">
									<table class="table table-bordered">
										<tr><td>Работаем</td></tr>
										<tr>
											<th style="text-align:center">
												<script type="text/javascript">
													d0 = new Date('March 02, 2018');
													d1 = new Date();
													dt = (d1.getTime() - d0.getTime()) / (1000*60*60*24);
													document.write(Math.round(dt));
												</script> дней
											</th>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mg-b-20">
							<div class="row">
								<div class="col-lg-3">
									<table class="table table-bordered">
										<tr><td>Пользователей</td></tr>
										<tr>
											<?php
												$users_all = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count` FROM `users`"));
												echo '<th style="text-align:center">'.number_format($users_all['count'], 0 ,'', ' ').' чел.</th>';
											?>
										</tr>
									</table>
								</div>
								<div class="col-lg-3">
									<table class="table table-bordered">
										<tr><td>За сутки</td></tr>
										<tr>
											<?php
												$users_day = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count` FROM `users` WHERE `date_vh`>='". date('Y-m-d') ." 00:00:00'"));
												echo '<th style="text-align:center">'.number_format($users_day['count'], 0 ,'', ' ').' чел.</th>';
											?>
										</tr>
									</table>
								</div>
								<div class="col-lg-3">
									<table class="table table-bordered">
										<tr><td>Пополнено</td></tr>
										<tr>
											<?php
												$money_all = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(`money`) as `sum` FROM `users_money`"));
												echo '<th style="text-align:center">'.number_format($money_all['sum'], 0 ,'', ' ').' руб.</th>';
											?>
										</tr>
									</table>
								</div>
								<div class="col-lg-3">
									<table class="table table-bordered">
										<tr><td>Выплачено</td></tr>
										<tr>
											<?php
												$vivod_all = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(`money`) as `sum` FROM `users_vivod`"));
												echo '<th style="text-align:center">'.number_format($vivod_all['sum'], 0 ,'', ' ').' руб.</th>';
											?>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mg-b-20">
							<h5 class="tx-info mg-b-25">Последние 10 пополнений</h5>
							<table class="table table-bordered">
								<tr>
									<th>Логин</th>
									<th>Сумма</th>
									<th>Дата</th>
								</tr>
								<?php
									$sql_pop = mysqli_query($mysqli, "SELECT `id_users`, `money`, `date` FROM `users_money` ORDER by `date` DESC LIMIT 0,10");
									while($row_pop = mysqli_fetch_assoc($sql_pop)) {
										$user_pop = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `login` from `users` where `id`='".$row_pop['id_users']."'"));
										echo '<tr>';
										echo '<td>'.$user_pop['login'].'</td>';
										echo '<td>'.number_format($row_pop['money'], 2, '.', ' ').' руб.</td>';
										echo '<td>'.date_format(date_create($row_pop['date']), 'd.m.Y в H:i').'</td>';
										echo '</tr>';
									}
								?>	
							</table>
						</div>
						<div class="col-lg-12 mg-b-20">
							<h5 class="tx-danger mg-b-25">Последние 10 выплат</h5>
							<table class="table table-bordered">
								<tr>
									<th>Логин</th>
									<th>Сумма</th>
									<th>Дата</th>
								</tr>
								<?php
									$sql_viv = mysqli_query($mysqli, "SELECT `id_users`, `money`, `date` FROM `users_vivod` ORDER by `date` DESC LIMIT 0,10");
									while($row_viv = mysqli_fetch_assoc($sql_viv)) {
										$user_viv = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `login` from `users` where `id`='".$row_viv['id_users']."'"));
										echo '<tr>';
										echo '<td>'.$user_viv['login'].'</td>';
										echo '<td>'.number_format($row_viv['money'], 2, '.', ' ').' руб.</td>';
										echo '<td>'.date_format(date_create($row_viv['date']), 'd.m.Y в H:i').'</td>';
										echo '</tr>';
									}
								?>	
							</table>
						</div>
						<div class="col-lg-12 mg-b-20">
							<h5 class="tx-inverse mg-b-25">Последние 10 регистраций</h5>
							<table class="table table-bordered">
								<tr>
									<th>Логин</th>
									<th>Пригласил</th>
									<th>Дата</th>
								</tr>
								<?php
									$sql_reg = mysqli_query($mysqli, "SELECT `login`, `ref`, `date_reg` FROM `users` ORDER by `date_reg` DESC LIMIT 0,10");
									while($row_reg = mysqli_fetch_assoc($sql_reg)) {
										$user_reg = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `login` from `users` where `id`='".$row_reg['ref']."'"));
										echo '<tr>';
										echo '<td>'.$row_reg['login'].'</td>';
										echo '<td>';
											if($user_reg['login']) { echo $user_reg['login']; }
											else { echo ' - '; }
										echo '</td>';
										echo '<td>'.date_format(date_create($row_reg['date_reg']), 'd.m.Y в H:i').'</td>';
										echo '</tr>';
									}
								?>	
							</table>
						</div>
						<div class="col-lg-12 mg-b-20">
							<h5 class="tx-success mg-b-25">Лидеры по рефералам (1 ур.)</h5>
							<table class="table table-bordered">
								<tr>
									<th>Логин</th>
									<th>Рефералов</th>
									<th>Регистрация</th>
								</tr>
								<?php
									$sql_lref = mysqli_query($mysqli, "SELECT t1.`login`, t1.`id`, t1.`date_reg`, t2.`ref_count` FROM `users` AS t1 LEFT JOIN (SELECT `ref`, COUNT(*) AS `ref_count` FROM `users` GROUP BY `ref`) AS t2 ON t1.`id` = t2.`ref` ORDER BY t2.`ref_count` DESC LIMIT 0, 10");
									while($row_lref = mysqli_fetch_assoc($sql_lref)) {
										echo '<tr>';
										echo '<td>'.$row_lref['login'].'</td>';
										echo '<td>';
											if($row_lref['ref_count'] > 0) { echo $row_lref['ref_count']; }
											else { echo '0'; }
										echo ' чел.</td>';
										echo '<td>'.date_format(date_create($row_lref['date_reg']), 'd.m.Y в H:i').'</td>';
										echo '</tr>';
									}
								?>	
							</table>
						</div>
						<div class="col-lg-12 mg-b-20">
							<h5 class="tx-orange mg-b-25">Лидеры по пополнениям</h5>
							<table class="table table-bordered">
								<tr>
									<th>Логин</th>
									<th>Сумма</th>
									<th>Регистрация</th>
								</tr>
								<?php
									$sql_lpop = mysqli_query($mysqli, "SELECT `id_users`, SUM(`money`) as `sum` FROM `users_money` GROUP by `id_users` ORDER by `sum` DESC LIMIT 0, 10");
									while($row_lpop = mysqli_fetch_assoc($sql_lpop)) {
										$user_lpop = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `login`, `date_reg` from `users` where `id`='".$row_lpop['id_users']."'"));
										echo '<tr>';
										echo '<td>'.$user_lpop['login'].'</td>';
										echo '<td>'.number_format($row_lpop['sum'], 2, '.', ' ').' руб.</td>';
										echo '<td>'.date_format(date_create($user_lpop['date_reg']), 'd.m.Y в H:i').'</td>';
										echo '</tr>';
									}
								?>	
							</table>
						</div>
						<div class="col-lg-12 mg-b-20">
							<h5 class="tx-purple mg-b-25">Лидеры по заработку</h5>
							<table class="table table-bordered">
								<tr>
									<th>Логин</th>
									<th>Сумма</th>
									<th>Регистрация</th>
								</tr>
								<?php
									$sql_lzar = mysqli_query($mysqli, "SELECT `id_users`, SUM(`money`) as `sum` FROM `users_vivod` WHERE `vup`='1' GROUP by `id_users` ORDER by `sum` DESC LIMIT 0, 10");
									while($row_lzar = mysqli_fetch_assoc($sql_lzar)) {
										$user_lzar = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `login`, `date_reg` from `users` where `id`='".$row_lzar['id_users']."'"));
										echo '<tr>';
										echo '<td>'.$user_lzar['login'].'</td>';
										echo '<td>'.number_format($row_lzar['sum'], 2, '.', ' ').' руб.</td>';
										echo '<td>'.date_format(date_create($user_lzar['date_reg']), 'd.m.Y в H:i').'</td>';
										echo '</tr>';
									}
								?>	
							</table>
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
  </body>
</html>