<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));

	
		$sql_su = mysqli_query($mysqli, "SELECT `id`, `time` FROM `serf_add` WHERE `id_users`!='".$user['id']."'");
		while($row_su = mysqli_fetch_assoc($sql_su)) {                                      
			$ss_us = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `time_view` from `serf_users` where `id_serf` = '".$row_su['id']."' and `id_users`='".$user['id']."' and `end`='0' and `yes`='0'"));
			$time_dus = date('Y-m-d H:i:s', strtotime("+ ".$row_su['time']." seconds", strtotime($ss_us['time_view'])));
			$dnus = date('Y-m-d H:i:s');
			if($ss_us['id'] and $dnus >= $time_dus) {
				$delss = mysqli_query($mysqli, "DELETE FROM `serf_users` WHERE `id_users`='".$user['id']."' and `end`='0' and `yes`='0'");
				echo '<script type="text/javascript"> window.location.href="serf_view.php"; </script>';
			}
		}
   
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Серфинг сайтов</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    <div class="am-mainpanel">
		
		<div class="am-pagetitle">
			<h5 class="am-title">Серфинг сайтов</h5>
		</div>

		<div class="am-pagebody">       
			<div class="row row-sm">
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						
						<p>Нажмите на <b>«начать просмотр»</b> любой из доступных ссылок, дождитесь окончания таймера и получайте деньги на свой <b>баланс для вывода</b>! Средства заработанные в сёрфинге Вы можете тратить на расширение своей недвижимости, участвовать в азартных играх или просто вывести их из проекта любым удобным для Вас способом!</p>
						
						<div id="linkslot_204697" style="margin:0 auto;"><script src="https://linkslot.ru/bancode.php?id=204697" async></script></div>
						 
						<div id="linkslot_204698" style="margin:0 auto; margin-top:5px;"><script src="https://linkslot.ru/bancode.php?id=204698" async></script></div>
						
						
					</div>
				</div>	
			
				
					
						
						<?php
												$sql_serf = mysqli_query($mysqli, "SELECT * FROM `serf_add` WHERE `money`>0 and `id_users`!='".$user['id']."' ORDER by `color` DESC, `time` DESC, `link` DESC");
												while($row_serf = mysqli_fetch_assoc($sql_serf)) {
													
													$serf_users = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `time_view`, `yes` from `serf_users` where `id_serf` = '".$row_serf['id']."' and `id_users`='".$user['id']."' and `end`='0'"));
													
													$time_prov = date('Y-m-d H:i:s', strtotime("+48 hours", strtotime($serf_users['time_view'])));
													
													if(date('Y-m-d H:i:s') > $time_prov and $serf_users['yes'] == '1') {
														mysqli_query($mysqli, "UPDATE `serf_users` SET `end`='1' WHERE `id_serf`='".$row_serf['id']."' and `id_users`='".$user['id']."'");
														echo '<script type="text/javascript"> window.location.href="serf_view.php"; </script>';	
													}
													
													$time_d = date('Y-m-d H:i:s', strtotime("+ ".$row_serf['time']." seconds", strtotime($serf_users['time_view'])));
													$dn = date('Y-m-d H:i:s');		
													$dat1 = date_create($dn);
													$dat2 = date_create($time_d);
													$int = date_diff($dat1, $dat2);
													
													if($dn >= $time_d and $serf_users['yes'] == '0') {
														mysqli_query($mysqli, "DELETE FROM `serf_users` WHERE `id_serf`='".$row_serf['id']."' and `id_users`='".$user['id']."' and `end`='0'");
														echo '<script type="text/javascript"> window.location.href="serf_view.php"; </script>';	
													}
													
													/*** Цена для рекломадателя ***/
														if($row_serf['time'] == 20) { $timeR = 0; }
														else if($row_serf['time'] == 30) { $timeR = 0.005; }
														else if($row_serf['time'] == 40) { $timeR = 0.01; }
														else if($row_serf['time'] == 50) { $timeR = 0.015; }
														else if($row_serf['time'] == 60) { $timeR = 0.02; }
														else $timeR = 0;
														
														if($row_serf['color'] == 0) { $colorR = 0; }
														else if($row_serf['color'] == 1) { $colorR = 0.012; }
														else { $colorR = 0; }
														
														if($row_serf['link'] == 0) { $linkR = 0; }
														else if($row_serf['link'] == 1) { $linkR = 0.012; }
														else { $linkR = 0; }
														
														$priceR = 0.030 + $timeR + $colorR + $linkR;
													/*** [end]Цена для рекломадателя ***/
													
													if($row_serf['money'] >= $priceR) {
														if(!$serf_users['id']) {
														
															if($row_serf['time'] == 20) { $timeN = 0; }
															else if($row_serf['time'] == 30) { $timeN = 0.002; }
															else if($row_serf['time'] == 40) { $timeN = 0.005; }
															else if($row_serf['time'] == 50) { $timeN = 0.01; }
															else if($row_serf['time'] == 60) { $timeN = 0.015; }
															else $timeN = 0;
															
															if($row_serf['color'] == 0) { $colorN = 0; }
															else if($row_serf['color'] == 1) { $colorN = 0.008; }
															else { $colorN = 0; }
															
															if($row_serf['link'] == 0) { $linkN = 0; }
															else if($row_serf['link'] == 1) { $linkN = 0.008; }
															else { $linkN = 0; }
															
															$price = 0.025 + $timeN + $colorN + $linkN;
															
															echo '<div class="col-lg-12 mg-b-20"><div id="ser_'.$row_serf['id'].'" class="card pd-20" style="';
																if($row_serf['color'] == 1) { echo 'background:#ffead7;'; }
															echo '"><div class="row row-sm">';
															
																echo '<div class="col-sm-10">';
																	echo '<img src="https://www.google.com/s2/favicons?domain='.$row_serf['url'].'" width="16" height="16" style="margin-right:5px;"> ';
																	if($row_serf['color'] == 1) { echo '<b class="text-danger">'; }
																	else { echo '<b>'; }
																		echo $row_serf['name'].'</b>';
																	echo '<p>'.$row_serf['info'].'</p>';	
																echo '</div>';
																
																echo '<div class="col-sm-2" style="text-align:center; margin-top:14px;">';
																	echo '<i>'.$row_serf['time'].' сек.</i><br>';
																	echo '<b>'.$price.' руб.</b>';
																echo '</div>';
																
																echo '<div class="col-sm-12" style="text-align:center; margin-top:5px;">';
																	echo '<a href="http://realty-money.ru/serf.php?id='.$row_serf['id'].'" target="_blank" onclick="$(\'#ser_'.$row_serf['id'].'\').hide();">начать просмотр</a>';
																	echo ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://online.us.drweb.com/result/?url='.$row_serf['url'].'" class="text-danger" target="_blank">проверить на вирусы</a>';
																echo '</div>';
																
															echo '</div></div></div>';
														
														}														
													}
													
												}
											?>
						
					
				
				
			</div>       
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
	
</body>
</html>