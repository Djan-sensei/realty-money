<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban`, `pod`, `pod_code`, `pass_vivod`, `payeer`, `yandex`, `qiwi`, `visa`, `mastercard`, `maestro`, `beeline`, `megafon`, `mts`, `tele2` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
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
	<title>RealtyMoney - Настройки</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>    

    <div class="am-mainpanel">
	
		<div class="am-pagetitle">
			<h5 class="am-title">Настройки</h5>
		</div>
		
		<iframe name="Frame" style="display:none;"></iframe>

		<div class="am-pagebody">
			
			<?php if($user['pod'] == 0) { ?>
				<div class="card pd-20 pd-sm-40">
					<h6 class="card-body-title">Подтверждение почты</h6>
					<p class="mg-b-20 mg-sm-b-30">Подвердите Ваш почтовый ящик для активации аккаунта и возможности вывода накопленных средств.</p>
					<div class="form-layout">
						<form action="" method="post" target="Frame">
							<!-- <div class="row mg-b-25">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label">Пароль подтверждения: <span class="tx-danger">*</span></label>
										<input class="form-control" type="text" name="pass_email" value="" placeholder="Пароль подтверждения">
									</div>
								</div>
							</div> -->
							<div class="form-layout-footer">
								<!--<button name="email_yes" type="submit" class="btn btn-info mg-r-5">Подвердить</button>--> <button name="email_pass" type="submit" class="btn btn-success mg-r-5"><!--Отправить код на почту-->Активировать</button>
							</div>
						</form>
						<?php
							if (isset($_POST['email_yes'])) {
								$pass_email = mysqli_real_escape_string($mysqli, $_POST['pass_email']); 
								
								if($pass_email != $user['pod_code'] and $pod <= 0) {
									echo '<script type="text/javascript">top.alert("Код не совпадает!");</script>';
								} else {
									$sql_new_pass = mysqli_query($mysqli, "UPDATE `users` SET `pod_code`='0', `pod`='1' WHERE `id`='".$user['id']."'");
									echo '<script type="text/javascript"> top.alert("Успешно!"); top.window.location.href="settings.php"; </script>';
								}
							}
							
							if (isset($_POST['email_pass'])) {	
								/* if(!empty($user['pod'])) {
									$rand_pp = rand(100000000, 999999999);								
									$email = $user['email']; 								
									$message = '								
									Уважаемый <b>'.$user['login'].'</b>!<br>
									С Вашего аккаунта на проекте RealtyMoney был сформирован запрос на <b>подтверждение почты</b>, данные высланы на почту:								
									<br><br>								
									<b>Пароль подтверждения:</b> '.$rand_pp	.'<br>
									<a href="https://realty-money.ru/settings.php">Перейти в аккаунт</a>
									<br><br>С уважением, администрация проекта RealtyMoney.<br>
									<hr>
									<i>RealtyMoney - это увлекательный игровой симулятор с возможностью заработка и вывода реальных денег! Все что от Вас требуется это зарегистрироваться в нашем проекте, строить недвижимость и получать стабильный доход!</i>
									<hr>
									Внимание! Если вы не инициировали данное действие, то пожалуйста поменяйте свой пароль в настройках вашего аккаунта!';								
									mysqli_query($mysqli, "UPDATE `users` SET `pod_code`='".$rand_pp."' WHERE `id`='".$user['id']."'");
									$subject = "RealtyMoney | Подтверждение почты";
									$headers= "MIME-Version: 1.0\r\n";
									$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
									$headers .= "From: RealtyMoney <support@realty-money.ru>\r\n"; // от кого письмо
									mail($email, $subject, $message, $headers);
									echo '<script type="text/javascript">top.alert("Данные отправленны на почту!");</script>';
								} */
								
								mysqli_query($mysqli, "UPDATE `users` SET `pod_code`='0', `pod`='1' WHERE `id`='".$user['id']."'");
								
								echo '<script type="text/javascript">top.alert("Успешно!"); top.window.location.href="settings.php";</script>';
								
							}
						?>
					</div>
				</div>
			<?php } ?>
			
			<div class="card pd-20 pd-sm-40 mg-t-20">
				<h6 class="card-body-title">Изменение пароля</h6>
				<p class="mg-b-20 mg-sm-b-30">Новый и текущий пароли не должны совпадать.</p>
				<div class="form-layout">
					<form action="" method="post" target="Frame">
						<div class="row mg-b-25">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">Текущий пароль: <span class="tx-danger">*</span></label>
									<input class="form-control" type="password" name="pass" value="" placeholder="Текущий пароль">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">Новый пароль: <span class="tx-danger">*</span></label>
									<input class="form-control" type="text" name="new_pass" value="" placeholder="Новый пароль">
								</div>
							</div>
						</div>
						<div class="form-layout-footer">
							<button name="edit_pass" type="submit" class="btn btn-info mg-r-5">Сохранить</button>
						</div>
					</form>
					<?php
						if (isset($_POST['edit_pass'])) {
							$pass = mysqli_real_escape_string($mysqli, $_POST['pass']); 
							$new_pass = mysqli_real_escape_string($mysqli, $_POST['new_pass']); 
							
							$pass_prov = mysqli_fetch_array(mysqli_query($mysqli, "select `id` from `users` where `pass`='".$pass."' and `id`='".$user['id']."'"));
							
							if($pass == $new_pass) {
								echo '<script type="text/javascript">top.alert("Пароли совпадают!");</script>';
							} else if($pass_prov['id'] != $user['id']) {
								echo '<script type="text/javascript">top.alert("Текущий пароль введен не верно!");</script>';
							} else if(empty($pass) or empty($new_pass) or !ctype_alnum($new_pass)) {
								echo '<script type="text/javascript">top.alert("Ошибка! Пароль должен состоять из букв и цифр!");</script>';
							} else {
								$sql_new_pass = mysqli_query($mysqli, "UPDATE `users` SET `pass`='".$new_pass."' WHERE `id`='".$user['id']."'");
								$_SESSION['pass'] = $new_pass;
								echo '<script type="text/javascript"> top.alert("Успешно!"); top.window.location.href="settings.php"; </script>';
							}
						}
					?>
				</div>
			</div>

			
			<div class="card pd-20 pd-sm-40 mg-t-20">
				<h6 class="card-body-title">Платежный пароль</h6>
				<?php if(empty($user['pass_vivod'])) { ?>
					<p class="mg-b-20 mg-sm-b-30"><b>Обязательно устанавливайте платежный пароль!</b> Платежный пароль служит для защиты Ваших средств от мошенников, которые в результате различных махинаций могут завладеть Вашим аккаунтом.</p>
					<p class="mg-b-20 mg-sm-b-30">Установите платежный пароль, введя любую комбинацию, которую Вы не сможете забыть, после чего при каждой попытке вывода средств из проекта система будет запрашивать платежный пароль для осуществления выплаты.</p>
					<div class="form-layout">
						<form action="" method="post" target="Frame">
							<div class="row mg-b-25">
								<div class="col-lg-6">
									<div class="form-group">
										<input class="form-control" type="text" name="pass_vivod" value="" placeholder="Платежный пароль">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<button type="submit" name="edit_pass_vivod" class="btn btn-success mg-r-5">Сохранить</button>
									</div>
								</div>
							</div>
						</form>
						<?php
							if (isset($_POST['edit_pass_vivod'])) {
								$pass_vivod = mysqli_real_escape_string($mysqli, $_POST['pass_vivod']);
								
								if(empty($pass_vivod) or !ctype_alnum($pass_vivod)) {
									echo '<script type="text/javascript">top.alert("Платежный пароль должен состоять из букв и цифр!");</script>';
								} else {
									$sql_pass_vivod = mysqli_query($mysqli, "UPDATE `users` SET `pass_vivod`='".$pass_vivod."' WHERE `id`='".$user['id']."'");
									echo '<script type="text/javascript"> top.alert("Успешно!"); top.window.location.href="settings.php"; </script>';
								}
							}
						?>
					</div>
				<?php } else { ?>
					<p class="mg-b-20 mg-sm-b-30"><b>Платежный пароль установлен!</b> Если Вы забыли свой платежный пароль или хотите его изменить, для этого напишите в техподдержку <code>pass@realty-money.ru</code> с почты, на которую зарегистрирован Ваш аккаунт.</p>
				<?php } ?>
			</div>

			
			<div class="card pd-20 pd-sm-40 mg-t-20">
				<h6 class="card-body-title">Кошельки для выплат</h6>	
				<p class="mg-b-20 mg-sm-b-30">Для изменения кошелька напишите в техподдержку <code>support@realty-money.ru</code> с почты, на которую зарегистрирован Ваш аккаунт.</p>				
				<div class="form-layout">
					<form action="" method="post" target="Frame">
						<div class="row mg-b-25">
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Payeer (<a href="https://payeer.com/?partner=2487719" target="_blank">Создать кошелек</a>):</label>
									<?php if($user['payeer'] == '0' or $user['payeer'] == '') { ?>
										<input class="form-control" type="text" name="payeer" value="" placeholder="Формат: P1000000">
									<?php } else { ?>
										<input class="form-control" type="text" name="payeer" value="<?php echo substr_replace($user['payeer'],'*****',-5); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Яндекс.Деньги:</label>
									<?php if($user['yandex'] == '0' or $user['yandex'] == '') { ?>
										<input class="form-control" type="text" name="yandex" value="" placeholder="Формат: 410020030040050">
									<?php } else { ?>
										<input class="form-control" type="text" name="yandex" value="<?php echo substr_replace($user['yandex'],'*****',-5); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">QIWI Wallet:</label>
									<?php if($user['qiwi'] == '0' or $user['qiwi'] == '') { ?>
										<input class="form-control" type="text" name="qiwi" value="" placeholder="Формат: +79601002030">
									<?php } else { ?>
										<input class="form-control" type="text" name="qiwi" value="<?php echo substr_replace($user['qiwi'],'*****',-5); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">VISA:</label>
									<?php if($user['visa'] == '0' or $user['visa'] == '') { ?>
										<input class="form-control" type="text" name="visa" value="" placeholder="Формат: 412107XXXX785577">
									<?php } else { ?>
										<input class="form-control" type="text" name="visa" value="<?php echo substr_replace($user['visa'],'*******',-7); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">MASTERCARD:</label>
									<?php if($user['mastercard'] == '0' or $user['mastercard'] == '') { ?>
										<input class="form-control" type="text" name="mastercard" value="" placeholder="Формат: 512107XXXX785577">
									<?php } else { ?>
										<input class="form-control" type="text" name="mastercard" value="<?php echo substr_replace($user['mastercard'],'*******',-7); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">MAESTRO/CIRRUS:</label>
									<?php if($user['maestro'] == '0' or $user['maestro'] == '') { ?>
										<input class="form-control" type="text" name="maestro" value="" placeholder="Формат: 676102XXXX78551100">
									<?php } else { ?>
										<input class="form-control" type="text" name="maestro" value="<?php echo substr_replace($user['maestro'],'*******',-7); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Билайн:</label>
									<?php if($user['beeline'] == '0' or $user['beeline'] == '') { ?>
										<input class="form-control" type="text" name="beeline" value="" placeholder="Формат: +79030001122">
									<?php } else { ?>
										<input class="form-control" type="text" name="beeline" value="<?php echo substr_replace($user['beeline'],'*****',-5); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Мегафон:</label>
									<?php if($user['megafon'] == '0' or $user['megafon'] == '') { ?>
										<input class="form-control" type="text" name="megafon" value="" placeholder="Формат: +79230001122">
									<?php } else { ?>
										<input class="form-control" type="text" name="megafon" value="<?php echo substr_replace($user['megafon'],'*****',-5); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">МТС:</label>
									<?php if($user['mts'] == '0' or $user['mts'] == '') { ?>
										<input class="form-control" type="text" name="mts" value="" placeholder="Формат: +79130001122">
									<?php } else { ?>
										<input class="form-control" type="text" name="mts" value="<?php echo substr_replace($user['mts'],'*****',-5); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label class="form-control-label">Теле2:</label>
									<?php if($user['tele2'] == '0' or $user['tele2'] == '') { ?>
										<input class="form-control" type="text" name="tele2" value="" placeholder="Формат: +79510001122">
									<?php } else { ?>
										<input class="form-control" type="text" name="tele2" value="<?php echo substr_replace($user['tele2'],'*******',-7); ?>" disabled="">
									<?php } ?>
								</div>
							</div>
						</div>						
						<div class="form-layout-footer">
							<button name="edit_kosh" type="submit" class="btn btn-primary mg-r-5">Сохранить</button>
						</div>
					</form>
					<?php
						if (isset($_POST['edit_kosh'])) {							
							if($user['yandex'] == '0' or $user['yandex'] == '') {
								$yandex = mysqli_real_escape_string($mysqli, $_POST['yandex']);
							} else {
								$yandex = $user['yandex'];
							}
							if($user['qiwi'] == '0' or $user['qiwi'] == '') {
								$qiwi = mysqli_real_escape_string($mysqli, $_POST['qiwi']);
							} else {
								$qiwi = $user['qiwi'];
							}
							if($user['payeer'] == '0' or $user['payeer'] == '') {
								$payeer = mysqli_real_escape_string($mysqli, $_POST['payeer']);
							} else {
								$payeer = $user['payeer'];
							}	
							if($user['visa'] == '0' or $user['visa'] == '') {
								$visa = mysqli_real_escape_string($mysqli, $_POST['visa']);
								$visa = preg_replace("/[^0-9]/", '', $visa);
							} else {
								$visa = $user['visa'];
							}	
							if($user['mastercard'] == '0' or $user['mastercard'] == '') {
								$mastercard = mysqli_real_escape_string($mysqli, $_POST['mastercard']);
								$mastercard = preg_replace("/[^0-9]/", '', $mastercard);
							} else {
								$mastercard = $user['mastercard'];
							}	
							if($user['maestro'] == '0' or $user['maestro'] == '') {
								$maestro = mysqli_real_escape_string($mysqli, $_POST['maestro']);
								$maestro = preg_replace("/[^0-9]/", '', $maestro);
							} else {
								$maestro = $user['maestro'];
							}	
							if($user['beeline'] == '0' or $user['beeline'] == '') {
								$beeline = mysqli_real_escape_string($mysqli, $_POST['beeline']);
							} else {
								$beeline = $user['beeline'];
							}	
							if($user['megafon'] == '0' or $user['megafon'] == '') {
								$megafon = mysqli_real_escape_string($mysqli, $_POST['megafon']);
							} else {
								$megafon = $user['megafon'];
							}	
							if($user['mts'] == '0' or $user['mts'] == '') {
								$mts = mysqli_real_escape_string($mysqli, $_POST['mts']);
							} else {
								$mts = $user['mts'];
							}	
							if($user['tele2'] == '0' or $user['tele2'] == '') {
								$tele2 = mysqli_real_escape_string($mysqli, $_POST['tele2']);
							} else {
								$tele2 = $user['tele2'];
							}							
							$sql_pass_vivod = mysqli_query($mysqli, "UPDATE `users` SET `yandex`='".$yandex."', `payeer`='".$payeer."', `qiwi`='".$qiwi."', `visa`='".$visa."', `mastercard`='".$mastercard."', `maestro`='".$maestro."', `beeline`='".$beeline."', `megafon`='".$megafon."', `mts`='".$mts."', `tele2`='".$tele2."' WHERE `id`='".$user['id']."'");
							echo '<script type="text/javascript"> top.alert("Успешно!"); top.window.location.href="settings.php"; </script>';
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