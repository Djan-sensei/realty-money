<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Управление серфингом</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    <div class="am-mainpanel">
		
		<div class="am-pagetitle">
			<h5 class="am-title">Управление серфингом</h5>
		</div>

		<div class="am-pagebody">       
			<div class="row row-sm">
					
				<?php if($_GET['id'] < 1) { ?>
					
					<?php
						$sql_serf = mysqli_query($mysqli, "SELECT * FROM `serf_add` WHERE `id_users`='".$user['id']."'");
						while($row_serf = mysqli_fetch_assoc($sql_serf)) {
					?>
					
						<div class="col-lg-12 mg-b-20">
							<div class="card pd-20">
								<table class="table table-bordered">
									<tr>
										<td colspan="2">
											<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15"><?php echo $row_serf['name']; ?></h6>
											<?php echo $row_serf['info']; ?>
										</td>
									</tr>
									<tr>
										<th>Ссылка:</th>
										<td><?php echo $row_serf['url']; ?></td>
									</tr>
									<tr>
										<th>Стоимость:</th>
										<td>
											<?php 
												if($row_serf['time'] == 20) { $timeN = 0; }
												else if($row_serf['time'] == 30) { $timeN = 0.005; }
												else if($row_serf['time'] == 40) { $timeN = 0.01; }
												else if($row_serf['time'] == 50) { $timeN = 0.015; }
												else if($row_serf['time'] == 60) { $timeN = 0.02; }
												else $timeN = 0;
												
												if($row_serf['color'] == 0) { $colorN = 0; }
												else if($row_serf['color'] == 1) { $colorN = 0.012; }
												else { $colorN = 0; }
												
												if($row_serf['link'] == 0) { $linkN = 0; }
												else if($row_serf['link'] == 1) { $linkN = 0.012; }
												else { $linkN = 0; }
												
												$price = 0.030 + $timeN + $colorN + $linkN;
												
												echo $price.' руб.';
											?>
										</td>
									</tr>
									<tr>
										<th>Просмотров:</th>
										<td><?php echo $row_serf['views']; ?></td>
									</tr>												
									<tr>
										<th>Баланс:</th>
										<td><?php echo 0+$row_serf['money']; ?> руб.</td>
									</tr>												
									<tr>
										<td colspan="2">
											<a href="serf_my.php?id=<?php echo $row_serf['id']; ?>" class="btn btn-primary btn-sm">Редактировать</a> 
											<?php if($row_serf['money'] <= 0.9) { ?>
												<iframe name="Frame" style="display:none;"></iframe>
												<form action="" method="post" target="Frame" style="display:inline-block;">
													<input type="submit" class="btn btn-danger btn-sm" name="del_<?php echo $row_serf['id']; ?>"  value="Удалить">
												</form>
											<?php } ?>
										</td>
									</tr>
								</table>
								
								<?php
								$dell = 'del_'.$row_serf['id'];
									if(isset($_POST[$dell])) {									
										mysqli_query($mysqli, "DELETE FROM `serf_add` WHERE `id_users`='".$user['id']."' and `id`='".$row_serf['id']."'");															
										echo '<script type="text/javascript"> top.alert("Сайт удален!"); top.window.location.href="serf_my.php"; </script>';
									}
								?>
								
								<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Пополнить баланс кампании</h6>
									
								<div class="row row-sm">
									<div class="col-lg-6">
										
											<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="control-label">Сумма</label>
														<input type="number" id="sum" name="sum" class="form-control" value="100">
													</div>
												</div>
												<div class="col-lg-12 form-group">
													<label for="" class="control-label">Способ оплаты</label>
													<select name="paymentType" class="form-control">
														<option value="PC">Яндекс Деньги</option>
														<option value="AC">Банковская карт</option>
													</select>
												</div>
												<div class="col-lg-12 form-group">
													<div class="control-label"></div>	
													<input type="hidden" name="receiver" value="**************">
													<input type="hidden" name="formcomment" value="serf_<?php echo $row_serf['id']; ?>">
													<input type="hidden" name="label" value="serf_<?php echo strval($row_serf['id']); ?>">
													<input type="hidden" name="quickpay-form" value="shop">
													<input type="hidden" name="targets" value="пополнение серфинга ID <?php echo $row_serf['id']; ?>">
													<input type="hidden" name="successURL" value="**************">
													<input type="submit" class="btn btn-success" name="submit-button"  value="Пополнить">
												</div>
											</form>
										
									</div>
									<div class="col-lg-6">													
										<form method="GET" action="payeer_get.php">
											<div class="col-lg-12 form-group">
												<label for="" class="control-label">Сумма</label>				
												<input type="number" id="m_amount" name="m_amount" class="form-control" value="100">
												<input type="hidden" id="par" name="par" class="form-control" value="serf" readonly>
												<input type="hidden" id="id_serf" name="id_serf" class="form-control" value="<?php echo $row_serf['id']; ?>" readonly>
											</div>
											<div class="col-lg-12  form-group">
												<label for="" class="control-label">Способ оплаты</label>
												<select class="form-control">
													<option value="Payeer">Payeer</option>
												</select>
											</div>
											<div class="col-lg-12 form-group">
												<div class="control-label"></div>
												<input type="submit" class="btn btn-info" name="m_process"  value="Пополнить">
											</div>														
										</form>													
									</div>
								</div>
								
							</div>
						</div>
						
					<?php } ?>
				
				<?php } else { ?>
				
					<?php
						$row_serf = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `serf_add` WHERE `id_users`='".$user['id']."' and `id`='". (int)$_GET['id'] ."'"));
					?>
				
					<div class="col-lg-12 mg-b-20">
						<div class="card pd-20">
							<iframe name="Frame" style="display:none;"></iframe>
							<form action="" method="post" target="Frame">
								<table class="table table-bordered">
									<tr>
										<td colspan="2">
											<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15"><?php echo $row_serf['name']; ?></h6>
										</td>
									</tr>
									<tr>
										<th>Название:</th>
										<td><input type="text" id="name" name="name" class="form-control" value="<?php echo $row_serf['name']; ?>"></td>
									</tr>
									<tr>
										<th>Описание:</th>
										<td><input type="text" id="info" name="info" class="form-control" value="<?php echo $row_serf['info']; ?>"></td>
									</tr>
									<tr>
										<th>Ссылка:</th>
										<td><input type="text" id="url" name="url" class="form-control" value="<?php echo $row_serf['url']; ?>"></td>
									</tr>
									<tr>
										<th>Время просмотра:</th>
										<td>
											<select class="form-control" id="time" name="time" onchange="Sum();">
												<option value="20" <?php if($row_serf['time'] == '20') { echo ' selected="selected" '; } ?>>20 секунд</option>
												<option value="30" <?php if($row_serf['time'] == '30') { echo ' selected="selected" '; } ?>>30 секунд (+ 0.005 руб.)</option>
												<option value="40" <?php if($row_serf['time'] == '70') { echo ' selected="selected" '; } ?>>40 секунд (+ 0.01 руб.)</option>
												<option value="50" <?php if($row_serf['time'] == '50') { echo ' selected="selected" '; } ?>>50 секунд (+ 0.015 руб.)</option>
												<option value="60" <?php if($row_serf['time'] == '60') { echo ' selected="selected" '; } ?>>60 секунд (+ 0.02 руб.)</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>Выделить ссылку:</th>
										<td>
											<select class="form-control" id="color" name="color" onchange="Sum();">
												<option value="0" <?php if($row_serf['color'] == '0') { echo ' selected="selected" '; } ?>>Нет</option>
												<option value="1" <?php if($row_serf['color'] == '1') { echo ' selected="selected" '; } ?>>Да (+ 0.012 руб.)</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>Последующий переход на сайт:</th>
										<td>
											<select class="form-control" id="link" name="link" onchange="Sum();">
												<option value="0" <?php if($row_serf['link'] == '0') { echo ' selected="selected" '; } ?>>Нет</option>
												<option value="1" <?php if($row_serf['link'] == '1') { echo ' selected="selected" '; } ?>>Да (+ 0.012 руб.)</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>Стоимость:</th>
										<td>
											<?php 
												if($row_serf['time'] == 20) { $timeN = 0; }
												else if($row_serf['time'] == 30) { $timeN = 0.005; }
												else if($row_serf['time'] == 40) { $timeN = 0.01; }
												else if($row_serf['time'] == 50) { $timeN = 0.015; }
												else if($row_serf['time'] == 60) { $timeN = 0.02; }
												else $timeN = 0;
												
												if($row_serf['color'] == 0) { $colorN = 0; }
												else if($row_serf['color'] == 1) { $colorN = 0.012; }
												else { $colorN = 0; }
												
												if($row_serf['link'] == 0) { $linkN = 0; }
												else if($row_serf['link'] == 1) { $linkN = 0.012; }
												else { $linkN = 0; }
												
												$price = 0.030 + $timeN + $colorN + $linkN;
											?>
											<span id="itog"><?php echo $price; ?></span> руб.
										</td>
									</tr>												
									<tr>
										<td colspan="2"><input type="submit" class="btn btn-success" name="save"  value="Сохранить изменения"> <a href="serf_my.php" class="btn btn-danger">Закрыть</a></td>
									</tr>
									<tr>
										<th>Просмотров:</th>
										<td><?php echo $row_serf['views']; ?></td>
									</tr>												
									<tr>
										<th>Баланс:</th>
										<td><?php echo 0+$row_serf['money']; ?> руб.</td>
									</tr>
								</table>
								
								<?php
									if(isset($_POST['save'])) {
									
										$name = mysqli_real_escape_string($mysqli, $_POST['name']);
										$name = strip_tags($name);
										$name = htmlspecialchars($name);
									
										$info = mysqli_real_escape_string($mysqli, $_POST['info']);
										$info = strip_tags($info);
										$info = htmlspecialchars($info);
									
										$url = mysqli_real_escape_string($mysqli, $_POST['url']);
										$url = strip_tags($url);
										$url = htmlspecialchars($url);
									
										$time = mysqli_real_escape_string($mysqli, $_POST['time']);
										$time = strip_tags($time);
										$time = htmlspecialchars($time);
									
										$color = mysqli_real_escape_string($mysqli, $_POST['color']);
										$color = strip_tags($color);
										$color = htmlspecialchars($color);
									
										$link = mysqli_real_escape_string($mysqli, $_POST['link']);
										$link = strip_tags($link);
										$link = htmlspecialchars($link);

										if(!empty($name) and !empty($info) and !empty($url)) {
											mysqli_query($mysqli, "UPDATE `serf_add` SET `name`='".$name."', `info`='".$info."', `url`='".$url."', `time`='".$time."', `color`='".$color."', `link`='".$link."'  WHERE `id_users`='".$user['id']."' and `id`='".$row_serf['id']."'");															
											echo '<script type="text/javascript"> top.alert("Изменения сохранены!"); top.window.location.href="serf_my.php"; </script>';
										} else {
											echo '<script type="text/javascript"> top.alert("Не все поля заполнены!"); </script>';
										}
										
									}
								?>
								
							</form>
						</div>
					</div>
				
				<?php } ?>
								
			</div>       
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
	
	<?php if($_GET['id'] > 0) { ?>
		<script>
			function Sum(num) {
				var itog = 0.030;
				var timeN = 0;
				var colorN = 0;
				
				var time = $("#time :selected").val();
				var color = $("#color :selected").val();
				var link = $("#link :selected").val();
				
				if(time == 20) { timeN = 0; }
				else if(time == 30) { timeN = 0.005; }
				else if(time == 40) { timeN = 0.01; }
				else if(time == 50) { timeN = 0.015; }
				else if(time == 60) { timeN = 0.02; }
				
				if(color == 0) { colorN = 0; }
				else if(color == 1) { colorN = 0.012; }
				
				if(link == 0) { linkN = 0; }
				else if(link == 1) { linkN = 0.012; }
				
				var it = Number(itog) + Number(timeN) + Number(colorN) + Number(linkN);
				
				$("#itog").html(it.toFixed(3));			
			}
		</script>
	<?php } ?>
	
</body>
</html>