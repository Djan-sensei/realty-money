<?php
	$mysqli = mysqli_connect("localhost", "*********", "*********", "*********");
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
	
	// Бонус
	$user_bon = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `date` from `users_bonus` where `id_users`='".$user['id']."' ORDER by `date` DESC LIMIT 0,1"));
	
	$dbon = new DateTime($user_bon['date']);
	$dbon->modify("+1 day");
	$bon_date = $dbon->format("Y-m-d H:i:s");
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
			<h5 class="am-title">Ежедневный бонус</h5>
		</div>

		<div class="am-pagebody">
		
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card pd-20">
						<p class="mg-b-20 mg-sm-b-30">Каждый пользователь проекта имеет возможность раз в сутки получить ежедневный бонус на счет для покупок, сумма бонуса 0,01 - 1 рубль. Благодаря ежедневному бонусу, сёрфингу сайтов и/или партнерской программе пользователи проекта, которые решили участвовать в проекте без вложений могут накопить на постройки начальных уровней, тем самым заработать реальные деньги без инвестиций.</p>
						<?php if(date('Y-m-d H:i:s') >= $bon_date or !$user_bon['id']) { ?>
							<iframe name="Frame" style="display:none;"></iframe>
							<form accept-charset="utf-8" action="" method="post" target="Frame">
								<div class="d-flex">									
									<input type="submit" name="bonus" style="margin:0 auto; cursor:pointer;" class="btn btn-success" value="Получить бонус">
									<?php
										if(isset($_POST['bonus'])) {
											$rand = rand(1,100);
											if($rand == 100) { $monp = 1; }
											else if($rand >= 10) { $monp = '0.'.$rand; }
											else { $monp = '0.0'.$rand; }
											$mon = round(($user['money_pok']+$monp), 4);
											$mon1 = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`='".$mon."' WHERE `id`='".$user['id']."'") or die(mysqli_error());
											$mon2 = mysqli_query($mysqli, "INSERT INTO `users_bonus`(`id_users`, `money`, `date`) VALUES ('".$user['id']."', '".$monp."', '". date('Y-m-d H:i:s') ."')") or die(mysqli_error());
											echo '<script type="text/javascript">top.alert("Успешно, Вы получили '.$monp.' руб.!"); top.window.location.href="bonus.php";</script>';
											exit;
										}
									?>										
								</div> 
							</form>							
						<?php } else { ?>
							<div class="d-flex" style="margin:0 auto;">Следующий бонус доступен: &nbsp; <b> <?php echo date_format(date_create($bon_date), ' d.m.Y в H:i'); ?></b></div>
						<?php } ?>
					</div>
				</div>
			</div>
			
			<div class="row row-sm mg-t-15 mg-sm-t-20">
				<div class="col-md-12">
					<div class="card pd-20 pd-sm-40">
						<h6 class="card-body-title">Последние 20 полученных бонусов</h6>
						<p class="mg-b-20 mg-sm-b-30">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>Логин</th>
										<th>Сумма</th>
										<th>Когда получил</th>
									</tr>
									<?php
										$sql_n = mysqli_query($mysqli, "SELECT `id_users`, `money`, `date` FROM `users_bonus` ORDER by `date` DESC LIMIt 0,20");
										while($row_n = mysqli_fetch_assoc($sql_n)) {
											$user_l = mysqli_fetch_array(mysqli_query($mysqli, "select `login` from `users` where `id`='".$row_n['id_users']."'"));
									?>	
											<tr>
												<td><?php echo $user_l['login'];?></td>
												<td><?php echo $row_n['money'];?> руб.</td>
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