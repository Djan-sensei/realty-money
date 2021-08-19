<?php
	$mysqli = mysqli_connect("localhost", "*********", "*********", "*********");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
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
	
	// Бонус 2
	$user_bon = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `prov`, `vk_page` from `users_bonus2` where `id_users`='".$user['id']."'"));
	
	// Бонус 3
	$user_bon3 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `date`, `prov`, `page` from `users_bonus3` where `id_users`='".$user['id']."' ORDER by `date` DESC LIMIT 0,1"));
	
	// Бонус видео
	$user_video = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `prov`, `link` from `users_bonus_video` where `id_users`='".$user['id']."'"));
	
	// Бонус реф
	$user_ref = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `prov` from `users_bonus_ref` where `id_users`='".$user['id']."'"));
	
	$dbon = new DateTime($user_bon3['date']);
	$dbon->modify("+5 day");
	$bon_date = $dbon->format("Y-m-d H:i:s");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Дополнительные бонусы</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    

    <div class="am-mainpanel">
		<div class="am-pagetitle">
			<h5 class="am-title">Дополнительные бонусы</h5>
		</div>

		<div class="am-pagebody">
		
			<div class="row row-sm mg-b-20">
				<div class="col-lg-12">
					<div class="card pd-20 mg-b-20 mg-sm-b-30">
						<h6 class="card-body-title">Подпишитесь на группу ВК и получите дополнительный бонус.</h6>
						<p class="mg-b-20 mg-sm-b-30">
							<br>Вы можете подписаться на группу, сделать репост на свою стену ВК и получить <code>5 руб.</code> для покупок.<br>
							<b class="txt-danger">Внимание! За выход из группы и удаление репоста будет вычтено 7 руб. со счета для покупок!</b>
							<br><br>
							Чтобы получить бонус, нужно:<br>
							1. Состоять в нашей группе вконтакте (<a href="https://vk.com/realty_money" target="_blank">https://vk.com/realty_money</a>)<br>
							2. Сделать репост записи (<a href="https://vk.com/wall-162800448_12" target="_blank">https://vk.com/wall-162800448_12</a>)<br>
							3. И нажмите кнопку - Подать заявку
						</p>
						<?php if(!$user_bon['id']) { ?>
							<iframe name="Frame" style="display:none;"></iframe>
							<form accept-charset="utf-8" action="" method="post" target="Frame">								
								<div class="row mg-b-25">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label">Ссылка на Вашу страницу в ВК: <span class="tx-danger">*</span></label>
											<input class="form-control" type="text" name="vk_page" value="" placeholder="Ссылка на Вашу страницу в ВК">
										</div>
									</div>
								</div>
								<div class="form-layout-footer">
									<input type="submit" name="bonus" style="margin:0 auto; cursor:pointer;" class="btn btn-success" value="Подать заявку">
									<?php
										if(isset($_POST['bonus'])) {
											$vk_page = mysqli_real_escape_string($mysqli, $_POST['vk_page']);
											if(!empty($vk_page)) {
												mysqli_query($mysqli, "INSERT INTO `users_bonus2`(`id_users`, `vk_page`) VALUES ('".$user['id']."', '".$vk_page."')") or die(mysqli_error());
												echo '<script type="text/javascript">top.alert("Успешно, после проверки будет начислен бонус!"); top.window.location.href="bonus_dop.php";</script>';
												exit;
											} else {
												echo '<script type="text/javascript">top.alert("Ошибка, Вы не добавили ссылку на Вашу страницу в ВК!"); top.window.location.href="bonus_dop.php";</script>';
											}
										}
									?>
								</div>
							</form>							
						<?php } else { ?>
							<div class="d-flex" style="margin:0 auto; text-align:center;">
								<code>									
									<?php if($user_bon['prov'] == 0) { ?>
										Проверка занимает от 1 до 24 часов.
									<?php } else { ?>
										Вы уже получили бонус
									<?php } ?>	
									<br/><?php echo $user_bon['vk_page']; ?>
								</code>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card pd-20 mg-b-20 mg-sm-b-30">
						<h6 class="card-body-title">Разместите выплату на форум.</h6>
						<p class="mg-b-20">
							Вы можете добавлять 1 раз в 5 дней отчет о выплате на один из форумов и получайте <code>3 руб.</code> для покупок.<br>
						</p>
						<p class="mg-b-15"><a href="https://mmgp.ru/showthread.php?t=570328" title="MMGP - Форум о заработке в Интернете и интернет-инвестировании" target="_blank"> <img src="img/monit/mmgp.gif" alt="MMGP - Форум о заработке в Интернете и интернет-инвестировании"></a> <a href="https://clck.ru/CtegU" title="MoneyMaker.team Делаем Деньги Вместе" target="_blank"> <img src="img/monit/moneymaker.jpg" alt="MoneyMaker.team Делаем Деньги Вместе"></a> <a href="https://clck.ru/Ctes3" title="ProfitHunters.ru - Форум о заработке и инвестициях в интернете" target="_blank"> <img src="img/monit/profithunters.jpg" alt="ProfitHunters.ru - Форум о заработке и инвестициях в интернете"></a> <a href="https://finforum.net/threads/realty-money-ru-realty-money.14230/" title="FinForum - Финансовый форум" target="_blank"> <img src="img/monit/finforum.jpg" alt="FinForum - Финансовый форум"></a> <a href="https://clck.ru/CttbK" title="Antimmgp.ru - заработок в Интернете, инвестиции и отзывы в Интернет" target="_blank"> <img src="img/monit/antimmgp.jpg" alt="Antimmgp.ru - заработок в Интернете, инвестиции и отзывы в Интернет"></a></p>
						<?php if(date('Y-m-d H:i:s') >= $bon_date or !$user_bon3['id']) { ?>
							<iframe name="Frame" style="display:none;"></iframe>
							<form accept-charset="utf-8" action="" method="post" target="Frame">								
								<div class="row mg-b-25">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label">Ссылка на Ваш пост: <span class="tx-danger">*</span></label>
											<input class="form-control" type="text" name="page" value="" placeholder="Ссылка на Ваш пост">
										</div>
									</div>
								</div>
								<div class="form-layout-footer">
									<input type="submit" name="bonus3" style="margin:0 auto; cursor:pointer;" class="btn btn-success" value="Подать заявку">
									<?php
										if(isset($_POST['bonus3'])) {
											$page = mysqli_real_escape_string($mysqli, $_POST['page']);
											if(!empty($page)) {
												mysqli_query($mysqli, "INSERT INTO `users_bonus3`(`id_users`, `page`, `date`) VALUES ('".$user['id']."', '".$page."', '". date('Y-m-d H:i:s') ."')") or die(mysqli_error());
												echo '<script type="text/javascript">top.alert("Успешно, после проверки будет начислен бонус!"); top.window.location.href="bonus_dop.php";</script>';
												exit;
											} else {
												echo '<script type="text/javascript">top.alert("Ошибка, Вы не добавили ссылку на Ваш пост!"); top.window.location.href="bonus_dop.php";</script>';
											}
										}
									?>
								</div>
							</form>							
						<?php } else { ?>
							<div class="d-flex" style="margin:0 auto; text-align:center;">
								<code>
									<?php if($user_bon3['prov'] == 0) { ?>
										Проверка занимает от 1 до 24 часов.
									<?php } else { ?>
										Следующий бонус доступен: <b> <?php echo date_format(date_create($bon_date), ' d.m.Y в H:i'); ?></b>
									<?php } ?>									
									<br/><br/>
									Указанная ссылка:<br/>
									<?php echo $user_bon3['page']; ?>
								</code>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			
			<?php /* ?>
			<div class="row row-sm mg-b-20">
				<div class="col-lg-12">
					<div class="card pd-20 mg-b-20 mg-sm-b-30">
						<h6 class="card-body-title">Выложите видео-обзор проекта на youtube</h6>
						<p class="mg-b-20 mg-sm-b-30">
							Сделайте обзор проекта и опубликуйте обзор на видеохостинге YouTube. Пришлите ссылку нам и получите награду в размере от 20 до 200 руб. на вывод.
						</p>
						<?php if(!$user_video['id']) { ?>
							<iframe name="Frame" style="display:none;"></iframe>
							<form accept-charset="utf-8" action="" method="post" target="Frame">								
								<div class="row mg-b-25">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label">Ссылка на видео: <span class="tx-danger">*</span></label>
											<input class="form-control" type="text" name="link" value="" placeholder="Ссылка на видео">
										</div>
									</div>
								</div>
								<div class="form-layout-footer">
									<input type="submit" name="video" style="margin:0 auto; cursor:pointer;" class="btn btn-success" value="Подать заявку">
									<?php
										if(isset($_POST['video'])) {
											$link = mysqli_real_escape_string($mysqli, $_POST['link']);
											if(!empty($link)) {
												mysqli_query($mysqli, "INSERT INTO `users_bonus_video`(`id_users`, `link`) VALUES ('".$user['id']."', '".$link."')") or die(mysqli_error());
												echo '<script type="text/javascript">top.alert("Успешно, после проверки будет начислен бонус!"); top.window.location.href="bonus_dop.php";</script>';
												exit;
											} else {
												echo '<script type="text/javascript">top.alert("Ошибка, Вы не добавили ссылку на видео!"); top.window.location.href="bonus_dop.php";</script>';
											}
										}
									?>
								</div>
							</form>							
						<?php } else { ?>
							<div class="d-flex" style="margin:0 auto; text-align:center;">
								<code>
									<?php if($user_video['prov'] == 0) { ?>
										Проверка занимает от 1 до 24 часов.
									<?php } else { ?>
										Вы получили бонус <?php echo $user_video['prov']; ?> руб.
									<?php } ?>
									<br/><?php echo $user_video['link']; ?>
								</code>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php */ ?>
			
			<div class="row row-sm mg-b-20">
				<div class="col-lg-12">
					<div class="card pd-20 mg-b-20 mg-sm-b-30">
						<h6 class="card-body-title">Наберите 30 рефералов в свою команду</h6>
						<p class="mg-b-20 mg-sm-b-30">
							Пригласите в проект 30 рефералов (1 уровня) благодаря «Партнерской программе» за любой промежуток времени, подайте заявку и получите награду в размере 30 руб. на вывод.
						</p>
						<?php if(!$user_ref['id']) { ?>
							<iframe name="Frame" style="display:none;"></iframe>
							<form accept-charset="utf-8" action="" method="post" target="Frame">								
								<div class="form-layout-footer">
									<input type="submit" name="ref" style="margin:0 auto; cursor:pointer;" class="btn btn-success" value="Подать заявку">
									<?php
										if(isset($_POST['ref'])) {
											$ref_kol = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count` FROM `users` WHERE `ref`='".$user['id']."'"));
											mysqli_query($mysqli, "INSERT INTO `users_bonus_ref`(`id_users`, `ref_kol`) VALUES ('".$user['id']."', '".$ref_kol['count']."')") or die(mysqli_error());
											echo '<script type="text/javascript">top.alert("Успешно, после проверки будет начислен бонус!"); top.window.location.href="bonus_dop.php";</script>';
											exit;
										}
									?>
								</div>
							</form>							
						<?php } else { ?>
							<div class="d-flex" style="margin:0 auto; text-align:center;">
								<code>
									<?php if($user_ref['prov'] == 0) { ?>
										Проверка занимает от 1 до 24 часов.
									<?php } else { ?>
										Вы получили бонус.
									<?php } ?>
								</code>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

        
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>