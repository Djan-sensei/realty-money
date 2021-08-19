<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$_SESSION['ref'] = $_GET['ref'];
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
	// Если пользователь не авторизирован
	if($_SERVER['PHP_SELF'] != '/signup.php' and $_SERVER['PHP_SELF'] != '/signin.php' and $_SERVER['PHP_SELF'] != '/index.php' and $_SERVER['PHP_SELF'] != '/' and $_SERVER['PHP_SELF'] != '/pass.php' and $_SERVER['PHP_SELF'] != '/stat.php') {
		if(!$user['id']) {
			echo '<script type="text/javascript"> window.location.href="/"; </script>';
			exit;
		}
	}
	
	// Если пользователь забанен
	if($user['ban'] == '1') {
		echo '<script type="text/javascript"> window.location.href="/ban_page.php"; </script>';
		exit;
	}
	
	
?>
