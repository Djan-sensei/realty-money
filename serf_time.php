<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
	if($_POST['id']) {
		$id = mysqli_real_escape_string($mysqli, $_POST['id']);
		$id = (int)$id;
	} else {
		$id = 1;
	}
	
	$serf = mysqli_fetch_array(mysqli_query($mysqli, "select `time` from `serf_add` where `id` = '".$id."'"));
	
	$serf_users = mysqli_fetch_array(mysqli_query($mysqli, "select `time_view` from `serf_users` where `id_serf` = '".$id."' and `id_users`='".$user['id']."' and `end`='0'"));	
	
	$time_d = date('Y-m-d H:i:s', strtotime("+ ".$serf['time']." seconds", strtotime($serf_users['time_view'])));
	$dn = date('Y-m-d H:i:s');		
	$dat1 = date_create($dn);
	$dat2 = date_create($time_d);
	$int = date_diff($dat1, $dat2);		
	
	if($time_d >= $dn) {
		echo '<br>
			<img src="/img/holdon.gif" style="float:left; margin-right:10px; width:45px;">
			<b style="font-size:18px;">'. $int->format('%s') .'</b><br>
			Дождитесь окончания таймера
		';		
	} else {			
		echo '<script type="text/javascript"> top.window.location.href="serf.php?id='.$id.'"; </script>';			
	}
?>


