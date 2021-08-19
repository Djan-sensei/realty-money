<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban`, `money_pok`, `money_viv`  FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
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
	<title>RealtyMoney - Обмен баланса</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>    

    <div class="am-mainpanel">
	
		<div class="am-pagetitle">
			<h5 class="am-title">Обмен баланса</h5>
		</div>
		
		<iframe name="Frame" style="display:none;"></iframe>

		<div class="am-pagebody">
			
			<div class="card pd-20 pd-sm-40">
				<h6 class="card-body-title">Обмен с ВЫВОДА на ПОКУПКИ</h6>
				<p class="mg-b-20 mg-sm-b-30">Односторонний обмен средств с Вашего баланса для вывода, на Ваш баланс для покупок. Мин. сумма: 1 руб.</p>
			
				<div class="form-layout">
					<form action="" method="post" target="Frame">
						<div class="row mg-b-25">
							<div class="col-lg-6">
								<div class="form-group">
									<input class="form-control" type="text" name="obm" value="" placeholder="Сумма обмена">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<button type="submit" name="start" class="btn btn-success mg-r-5">Обменять</button>
								</div>
							</div>
						</div>
					</form>
					<?php
						if (isset($_POST['start'])) {
							$obm = mysqli_real_escape_string($mysqli, $_POST['obm']);
							$obm = strip_tags($obm);
							$obm = htmlspecialchars($obm);
							$obm = (int)$obm;
							
							if(empty($obm) or $obm < 1) {
								echo '<script type="text/javascript">top.alert("Минимальная сумма обмена 1 руб.");</script>';
							} else if($obm > $user['money_viv']) {
								echo '<script type="text/javascript">top.alert("У Вас нет такой суммы");</script>';
							} else {
								$obm = round($obm, 2);
								$mon_viv = round(($user['money_viv']-$obm), 2);
								$mon_pok = round(($user['money_pok']+$obm), 2);
								$sql_pass_vivod = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`='".$mon_viv."', `money_pok`='".$mon_pok."' WHERE `id`='".$user['id']."'");
								echo '<script type="text/javascript"> top.alert("Успешно!"); top.window.location.href="obmen.php"; </script>';
							}
						}
					?>
				</div>
			</div>

		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>