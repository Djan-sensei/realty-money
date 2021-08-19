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
	<title>RealtyMoney - Вход в аккаунт</title>
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
						<p>У Вас нет аккаунт? <br> <a href="signup.php">Создайте</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<h5 class="tx-gray-800 mg-b-25">Вход в аккаунт</h5>
					<iframe name="Frame" style="display:none;"></iframe>
					<form accept-charset="utf-8" action="" method="post" target="Frame">
						<div class="form-group">
							<label class="form-control-label">Логин:</label>
							<input type="login" name="login" class="form-control" placeholder="Введите логин">
						</div>
						<div class="form-group">
							<label class="form-control-label">Пароль:</label>
							<input type="password" name="pass" class="form-control" placeholder="Введите пароль">
						</div>
						<div class="form-group mg-b-20"><a href="pass.php">Забыли пароль?!</a></div>
						<button type="submit" name="log" class="btn btn-block">Войти в игру</button>
					</form>
					<?php
						if(isset($_POST['log'])) {
							$post_login = mysqli_real_escape_string($mysqli, $_POST['login']);
							$post_pass = mysqli_real_escape_string($mysqli, $_POST['pass']);
							
							$r_log = mysqli_query($mysqli, "select * from `users` where `login` = '".$post_login."'");
							$a_log = mysqli_fetch_array($r_log);
							
							if($post_login == $a_log['login'] and $post_pass == $a_log['pass']) {
								$_SESSION['user'] = $a_log['login'];
								$_SESSION['pass'] = $a_log['pass'];
								
								$sql_vh = "UPDATE `users` SET `date_vh`='". date("Y-m-d H:i:s") ."' WHERE `id`='".$a_log['id']."'";
								$row_vh = mysqli_query($mysqli, $sql_vh) or die(mysqli_error());
								
								echo '<script type="text/javascript"> top.window.location.href="profile.php"; </script>';
								exit;
							} else {
								echo '<script type="text/javascript"> top.alert("Не верно введен логин или пароль!"); </script>';
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