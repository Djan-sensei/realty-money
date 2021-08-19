<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban`, `money_viv` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
	if($_GET['id']) {
		$id = (int)$_GET['id'];
	} else {
		$id = 1;
	}
	
	$serf = mysqli_fetch_array(mysqli_query($mysqli, "select * from `serf_add` where `id` = '".$id."'"));
	
	$serf_prov = mysqli_fetch_array(mysqli_query($mysqli, "select `id_serf` from `serf_users` where `id_users`='".$user['id']."' and `yes`='0' and `end`='0'"));
	
	$serf_users = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `id_serf`, `time_view`, `yes` from `serf_users` where `id_serf` = '".$serf['id']."' and `id_users`='".$user['id']."' and `end`='0'"));
	
	if($serf_prov['id_serf'] != $serf_users['id_serf']) {
		echo 'Вы уже просматриваете другой сайт...';
		exit;
	}
	
	if(!$serf_users['id']) {
		mysqli_fetch_array(mysqli_query($mysqli, "INSERT INTO `serf_users`(`id_serf`, `id_users`, `time_view`) VALUES ('".$id."', '".$user['id']."', '". date('Y-m-d H:i:s') ."')"));
	}
	
	$time_prov = date('Y-m-d H:i:s', strtotime("+24 hours", strtotime($serf_users['time_view'])));
	
	if($time_prov >= date('Y-m-d H:i:s') and $serf_users['yes'] == '1') {
		exit;
	}
	
	/*** Цена для пользователя ***/
		if($serf['time'] == 20) { $timeN = 0; }
		else if($serf['time'] == 30) { $timeN = 0.002; }
		else if($serf['time'] == 40) { $timeN = 0.005; }
		else if($serf['time'] == 50) { $timeN = 0.01; }
		else if($serf['time'] == 60) { $timeN = 0.015; }
		else $timeN = 0;
		
		if($serf['color'] == 0) { $colorN = 0; }
		else if($serf['color'] == 1) { $colorN = 0.008; }
		else { $colorN = 0; }
		
		if($serf['link'] == 0) { $linkN = 0; }
		else if($serf['link'] == 1) { $linkN = 0.008; }
		else { $linkN = 0; }
		
		$price = 0.025 + $timeN + $colorN + $linkN;
	/*** [end]Цена для пользователя ***/
	
	/*** Цена для рекломадателя ***/
		if($serf['time'] == 20) { $timeR = 0; }
		else if($serf['time'] == 30) { $timeR = 0.005; }
		else if($serf['time'] == 40) { $timeR = 0.01; }
		else if($serf['time'] == 50) { $timeR = 0.015; }
		else if($serf['time'] == 60) { $timeR = 0.02; }
		else $timeR = 0;
		
		if($serf['color'] == 0) { $colorR = 0; }
		else if($serf['color'] == 1) { $colorR = 0.012; }
		else { $colorR = 0; }
		
		if($serf['link'] == 0) { $linkR = 0; }
		else if($serf['link'] == 1) { $linkR = 0.012; }
		else { $linkR = 0; }
		
		$priceR = 0.030 + $timeR + $colorR + $linkR;
	/*** [end]Цена для рекломадателя ***/
	
	$time_d = date('Y-m-d H:i:s', strtotime("+ ".$serf['time']." seconds", strtotime($serf_users['time_view'])));
	$dn = date('Y-m-d H:i:s');		
	$dat1 = date_create($dn);
	$dat2 = date_create($time_d);
	$int = date_diff($dat1, $dat2);
?>

<iframe src="<?php echo $serf['url']; ?>" width="100%" height="80%"></iframe>

<div id="divp"></div>



	<?php if($time_d >= $dn or !$serf_users['id']) { ?>
	<script type="text/javascript" src="lib/jquery/jquery.js"></script>
	<script type="text/javascript">	
		function load_serf() {
			$.ajax({
				type: "POST",
				url:  "serf_time.php",
				data: "id=<?php echo $id; ?>",
				success: function(html) {
					$("#divp").empty();
					$("#divp").append(html);
				}
			});
		}

		load_serf();
		setInterval(load_serf, 1000);
	</script>
	<?php } else { ?>
	
	
	
						<iframe name="Frame" style="display:none;"></iframe>
	
						<form action="" method="post" target="Frame">
							
						
							<img src="captcha.php" style="float:left; margin-right:10px;">
							
							<input name="norobot" value="" class="form-control">
							<input type="submit" name="yes" value="Подтвердить" class="btn btn-danger" style="margin-top:10px;">
							
							<?php
								if(isset($_POST['yes'])) {
											
										if (md5($_POST['norobot']) != $_SESSION['randomnr2'])	{
											
											$sql_error = mysqli_query($mysqli, "UPDATE `serf_users` SET `time_view`='". date('Y-m-d H:i:s') ."' WHERE `id_serf`='".$id."' and `id_users`='".$user['id']."' and `end`='0'");
											
											echo '<script type="text/javascript"> top.alert("Неверно введена капча!"); top.window.location.href="serf.php?id='.$id.'"; </script>';
											exit;
										}
										
										$sql_ups = mysqli_query($mysqli, "UPDATE `serf_users` SET `yes`='1', `price`='". round($price, 4) ."' WHERE `id_serf`='".$id."' and `id_users`='".$user['id']."'");
										
										$mon = round($user['money_viv']+$price, 4);
										$mon_sql = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`='".$mon."' WHERE `id`='".$user['id']."'");
										
										$mon2 = round($serf['money']-$priceR, 4);
										$mon2_sql = mysqli_query($mysqli, "UPDATE `serf_add` SET `views`=`views`+1, `money`='".$mon2."' WHERE `id`='".$serf['id']."'");
										
										if($serf['link'] == 1) {
											echo '<script type="text/javascript"> top.alert("Оплата зачислена!"); top.window.location.href="'.$serf['url'].'"; </script>';
										} else {
											echo '<script type="text/javascript"> top.alert("Оплата зачислена!"); top.window.location.href="serf_view.php"; </script>';
										}
									
								}
							?>
						</form>
	
	
	<?php } ?>