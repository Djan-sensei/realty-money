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
	<title>RealtyMoney - Добавить сайт на серфинг</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    <div class="am-mainpanel">
		
		<div class="am-pagetitle">
			<h5 class="am-title">Добавить сайт на серфинг</h5>
		</div>

		<div class="am-pagebody">       
			<div class="row row-sm">
								
									<div class="col-lg-12 mg-b-20">
										<div class="card pd-20">
											<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Условия размещения рекламы</h6>
																						
											<p><b class="text-danger">Запрещается размещать рекламные ссылки на следующие ресурсы:</b></p>
											<ul>
												<li>содержащие вирусы и фишинговые сайты/ссылки</li>
												<li>сайты с редиректом на другие сайты, включая редирект сайта-источника</li>
												<li>разрушающие фрейм с таймером</li>
												<li>содержащие порнографию или обилие эротических материалов</li>
												<li>содержащие нецензурную и ненормативную лексику</li>
												<li>секс-шопы и доски знакомств типа "на одну ночь"</li>
												<li>сообщества нетрадиционной сексуальной ориентации</li>
												<li>призывающие к насилию, расизму, национализму, аморальному поведению</li>
												<li>политические и религиозные ресурсы</li>
												<li>ресурсы для сбора пожертвований, кроме официальных фондов и центров помощи</li>
												<li>ресурсы с элементами магии, спиритизма, оккультизма</li>
												<li>ресурсы, с явно выраженным обманом</li>
												<li>ресурсы, созданные "не для людей", т.е. набитые множеством партнёрок, всплывающих pop-up и т.д.</li>
												<li>ресурсы, требующие отправку платных СМС-сообщений</li>
												<li>сайты, которые неоправданно долго загружаются, вследствие слабого хостинга или обилия скрытых партнёрок</li>
												<li>ресурсы, нарушающие законодательство РФ</li>
											</ul>
											<p><b class="text-danger">За нарушение правил будет заблокирован аккаунт.</b></p>
											
										</div>
									</div>
								

								
									<div class="col-lg-12 mg-b-20">
										<div class="card pd-20">
											
											<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Серфинг (реклама) сайтов</h6>
											
											<iframe name="Frame" style="display:none;"></iframe>
											<form action="" method="post" target="Frame">
												<div class="row mg-b-25">
													<div class="col-lg-6 form-group">
														<label for="" class="control-label">Заголовок ссылки</label>
														<input type="text" id="name" name="name" class="form-control" value="">
													</div>
													<div class="col-lg-6 form-group">
														<label for="" class="control-label">Краткое описание ссылки</label>
														<input type="text" id="info" name="info" class="form-control" value="">
													</div>
													<div class="col-lg-6 form-group">
														<label for="" class="control-label">URL сайта (включая http://)</label>
														<input type="text" id="url" name="url" class="form-control" value="">
													</div>
													<div class="col-lg-6 form-group">
														<label for="" class="control-label">Время просмотра ссылки</label>
														<select class="form-control" id="time" name="time" onchange="Sum();">
															<option value="20">20 секунд</option>
															<option value="30">30 секунд (+ 0.005 руб.)</option>
															<option value="40">40 секунд (+ 0.01 руб.)</option>
															<option value="50">50 секунд (+ 0.015 руб.)</option>
															<option value="60">60 секунд (+ 0.02 руб.)</option>
														</select>
													</div>
													<div class="col-lg-6 form-group">
														<label for="" class="control-label">Выделить ссылку</label>
														<select class="form-control" id="color" name="color" onchange="Sum();">
															<option value="0">Нет</option>
															<option value="1">Да (+ 0.012 руб.)</option>
														</select>
													</div>
													<div class="col-lg-6 form-group">
														<label for="" class="control-label">Последующий переход на сайт</label>
														<select class="form-control" id="link" name="link" onchange="Sum();">
															<option value="0">Нет</option>
															<option value="1">Да (+ 0.012 руб.)</option>
														</select>
													</div>
													<div class="col-lg-6 form-group">
														<label for="" class="control-label">Стоимость одного просмотра</label>
														<code id="itog">0.030</code> руб.
													</div>
													<div class="col-lg-12 form-group">
														<input type="submit" id="add" name="add" class="btn btn-success" value="Добавить сайт">
													</div>
												</div>
											</form>
											
											<?php
												if(isset($_POST['add'])) {
												
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
														mysqli_query($mysqli, "INSERT INTO `serf_add`(`name`, `info`, `url`, `time`, `color`, `link`, `id_users`, `date_add`) VALUES ('".$name."', '".$info."', '".$url."', '".$time."', '".$color."', '".$link."', '".$user['id']."', '". date("Y-m-d H:i:s") ."')");															
														echo '<script type="text/javascript"> top.alert("Сайт добавлен!"); top.window.location.href="serf_my.php"; </script>';
													} else {
														echo '<script type="text/javascript"> top.alert("Не все поля заполнены!"); </script>';
													}
													
												}
											?>
											
										</div>
									</div>
									
									
								</div>       
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
	
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
	
</body>
</html>
								
	
	

