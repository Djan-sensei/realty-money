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
	<title>RealtyMoney - Восстановление пароля</title>
	<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
	<link rel="stylesheet" href="css/amanda.css">
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
					<h5 class="tx-gray-800 mg-b-25">Восстановление пароля</h5>
					<iframe name="Frame" style="display:none;"></iframe>
					<form accept-charset="utf-8" action="" method="post" target="Frame">
						<div class="form-group">
							<label class="form-control-label">E-mail:</label>
							<input type="email" name="email" class="form-control" placeholder="Введите e-mail">
						</div>
						<div class="form-group mg-b-20"><a href="signin.php">Войдите в аккаут</a></div>
						<button type="submit" name="pass" class="btn btn-block">Восстановить</button>
					</form>
					<?php
						if(isset($_POST['pass'])) {
							
							$post_email_zab = mysqli_real_escape_string($mysqli, $_POST['email']);
							
							$r_zab = mysqli_query($mysqli, "select `email`, `login`, `pass` from `users` where `email`='".$post_email_zab."'");
							$a_zab = mysqli_fetch_array($r_zab);
							
							if($post_email_zab == $a_zab['email']) {
								
								$email_zab = $a_zab['email']; 
								
								$message_zab = '
								
								Уважаемый <b>'.$a_zab['login'].'</b>!<br>
								С Вашего аккаунта на проекте RealtyMoney был сформирован запрос на <b>восстановление пароля</b>, данные высланы на почту:
								
								<br><br>
								
								<b>Логин:</b> '. $a_zab['login'].'<br/><b>Пароль:</b> '.$a_zab['pass']
								
								.'<br><br>С уважением, администрация проекта RealtyMoney.<br>
<hr>
<i>RealtyMoney - это увлекательный игровой симулятор с возможностью заработка и вывода реальных денег! Все что от Вас требуется это зарегистрироваться в нашем проекте, строить недвижимость и получать стабильный доход!</i>
<hr>
Внимание! Если вы не инициировали данное действие, то пожалуйста поменяйте свой пароль в настройках вашего аккаунта!';
								
								// тема письма
								$subject_zab = "RealtyMoney | Восстановление пароля";
								 
								// заголовок письма
								$headers_zab= "MIME-Version: 1.0\r\n";
								$headers_zab .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
								$headers_zab .= "From: RealtyMoney <support@realty-money.ru>\r\n"; // от кого письмо
								
								 
								// отправляем письмо 
								mail($email_zab, $subject_zab, $message_zab, $headers_zab);
								
								echo '<script type="text/javascript">top.alert("Данные отправленны на почту!");</script>';
							} else {
								echo '<script type="text/javascript">top.alert("Почта не найдена!");</script>';
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