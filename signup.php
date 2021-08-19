<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$_SESSION['ref'] = $_GET['ref'];
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
	if($user['id']) {
		echo '<script type="text/javascript"> window.location.href="profile.php"; </script>';
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Регистрация аккаунта</title>
	<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="css/amanda.css">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>    
	<div class="am-signup-wrapper" style="background:url('img/fon.jpg');">
		<div class="am-signup-box">
			<div class="row no-gutters">
				<div class="col-lg-5">
					<div>
						<h2>RealtyMoney</h2>
						<p>Окунитесь с головой в уникальный игровой механизм экономической игры с выводом денег realty-money.ru!</p>
						<hr>
						<p>У Вас уже есть аккаунт? <br> <a href="signin.php">Войдите</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<h5 class="tx-gray-800 mg-b-25">Регистрация аккаунта</h5>
					<iframe name="Frame" style="display:none;"></iframe>
					<form accept-charset="utf-8" action="" method="post" target="Frame">
						<div class="form-group">
							<label class="form-control-label">Email:</label>
							<input type="email" name="email" class="form-control" placeholder="Введите E-mail">
						</div>
						<div class="form-group">
							<label class="form-control-label">Логин:</label>
							<input type="text" name="login" class="form-control" placeholder="Введите логин">
						</div>
						<div class="form-group">
							<label class="form-control-label">Пароль:</label>
							<input type="password" name="pass" class="form-control" placeholder="Введите пароль">
						</div>
						<div class="form-group mg-b-20 tx-12">
							Нажимая кнопку «Зарегистрироваться» Вы подтверждаете, что вам исполнилось 18 лет, с <a href="terms.php" target="_blank">правилами проекта</a> ознакомлены и принимаете их.
						</div>
						<button type="submit" name="reg" class="btn btn-block">Зарегистрироваться</button>
					</form>
					<?php
						if(isset($_POST['reg'])) {
							$login = mysqli_real_escape_string($mysqli, $_POST['login']);
							$pass = mysqli_real_escape_string($mysqli, $_POST['pass']);
							$email = mysqli_real_escape_string($mysqli, $_POST['email']);							
							$r_log = mysqli_query($mysqli, "select * from `users` where `login` = '".$login."'");
							$a_log = mysqli_fetch_array($r_log);
							$r_log_em = mysqli_query($mysqli, "select * from `users` where `email` = '".$email."'");
							$a_log_em = mysqli_fetch_array($r_log_em);
							$r_ip_em = mysqli_query($mysqli, "select * from `users` where `ip_reg` = '".$_SERVER["REMOTE_ADDR"]."'");
							$a_ip_em = mysqli_fetch_array($r_ip_em);
							
							if(!ctype_alnum($login)) {
								echo '<script type="text/javascript">top.alert("Логин должен состоять только из букв и цифр.");</script>';
							} else if(!ctype_alnum($pass)) {
								echo '<script type="text/javascript">top.alert("Пароль должен состоять только из букв и цифр.");</script>';
							} else if(empty($login) or $login == ' ') {
								echo '<script type="text/javascript">top.alert("Логин не заполнен");</script>';
							} else if(empty($email) or $email == ' ') {
								echo '<script type="text/javascript">top.alert("E-mail не заполнен");</script>';
							} else if(empty($pass) or $pass == ' ') {
								echo '<script type="text/javascript">top.alert("Пароль не может быть пустым");</script>';
							} else {
								if(mb_strtolower($email) == mb_strtolower($a_log_em['email'])) {
									echo '<script type="text/javascript">top.alert("На данный e-mail уже зарегистрирован пользователь!");</script>';
								} else if(mb_strtolower($login) == mb_strtolower($a_log['login'])) {
									echo '<script type="text/javascript">top.alert("Пользователь с таким логином уже существует!");</script>';
								} else if(mb_strtolower($_SERVER["REMOTE_ADDR"]) == mb_strtolower($a_ip_em['ip_reg'])) {
									echo '<script type="text/javascript">top.alert("С данного IP адреса уже была произведена регистрация!");</script>';
								} else {										
									mysqli_query($mysqli, "INSERT INTO `users` (`login`, `pass`, `email`, `ref`, `date_reg`, `ip_reg`, `UserAgent`, `money_pok`, `date_vh`) VALUES ('".$login."', '".$pass."', '".$email."', '".$_SESSION['ref']."', '". date("Y-m-d H:i:s") ."', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["HTTP_USER_AGENT"]."', '10', '". date("Y-m-d H:i:s") ."') ") or die(mysqli_error());									
									$_SESSION['user'] = $login;
									$_SESSION['pass'] = $pass;									
									echo '<script type="text/javascript">top.window.location.href="profile.php";</script>';
								}						
							}
						}
					?>
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