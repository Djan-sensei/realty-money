<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
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
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Список рефералов</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    <div class="am-mainpanel">
		
		<div class="am-pagetitle">
			<h5 class="am-title">
				<?php if(!$_GET['id']) { ?>
					Рефералы 1 уровня (баланса)
				<?php } else if($_GET['id'] == 1) { ?>
					Рефералы 1 уровня (серфинг)
				<?php } else if($_GET['id'] == 2) { ?>
					Рефералы 2 уровня
				<?php } ?>
			</h5>
		</div>
		
		<div class="am-pagebody">       
			<div class="row row-sm">
			
				<div class="col-sm-4 mg-b-20">
					<div class="card pd-20" align="center">
						<a href="ref.php" class="btn btn-<?php if(!$_GET['id']) { echo 'success'; } else { echo 'info'; } ?>">1 уровень (баланс)</a>
					</div>
				</div>
			
				<div class="col-sm-4 mg-b-20">
					<div class="card pd-20" align="center">
						<a href="ref.php?id=1" class="btn btn-<?php if($_GET['id'] == 1) { echo 'success'; } else { echo 'info'; } ?>">1 уровень (серфинг)</a>
					</div>
				</div>
			
				<div class="col-sm-4 mg-b-20">
					<div class="card pd-20" align="center">
						<a href="ref.php?id=2" class="btn btn-<?php if($_GET['id'] == 2) { echo 'success'; } else { echo 'info'; } ?>">2 уровень</a> 
					</div>
				</div>
				
			</div>
		       
			<div class="row row-sm">
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						
						<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">
							<?php if(!$_GET['id']) { ?>
								Рефералы 1 уровня (Пополнение баланса)
							<?php } else if($_GET['id'] == 1) { ?>
								Рефералы 1 уровня (Пополнение рекламного баланса)
							<?php } else if($_GET['id'] == 2) { ?>
								Рефералы 2 уровня (Пополнение баланса)
							<?php } ?>
						</h6>
						
							<?php
							
								if(!$_GET['id']) {
									$ref_users_kol_sql = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count` FROM `users` WHERE `ref`='".$user['id']."'"));
									$ref_users_kol = $ref_users_kol_sql['count'];
								} else if($_GET['id'] == 1) {
									$ref_users_kol_sql = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count` FROM `users` WHERE `ref`='".$user['id']."'"));
									$ref_users_kol = $ref_users_kol_sql['count'];
								} else if($_GET['id'] == 2) {
									$sql_kol_ref2 = mysqli_query($mysqli, "SELECT `id` FROM `users` WHERE `ref`='".$user['id']."'");
									while($row_kol_ref2 = mysqli_fetch_assoc($sql_kol_ref2)) {
										$user_ref2c = mysqli_fetch_array(mysqli_query($mysqli, "select COUNT(*) as `count` from `users` where `ref`='".$row_kol_ref2['id']."'"));
										$ref_users_kol += $user_ref2c['count'];
									}									
								}
							
								if($ref_users_kol <= 0) { echo '<p class="tx-12 mg-b-15">Нет ни одного реферала...</p><p class="tx-12 mg-b-15">Хотите пригласить парнеров? Воспользуйтесь <a href="pmat.php">партнерской программой</a></p>'; }
								else {
									
									if(!$_GET['id']) {
										$row_tovar_num_sql = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count`FROM `users` WHERE `ref`='".$user['id']."'"));
										$row_tovar_num = $row_tovar_num_sql['count'];
									} else if($_GET['id'] == 1) {
										$row_tovar_num_sql = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count` FROM `users` WHERE `ref`='".$user['id']."'"));
										$row_tovar_num = $row_tovar_num_sql['count'];
									} else if($_GET['id'] == 2) {
										$sql_kol_ref2_kk = mysqli_query($mysqli, "SELECT `id` FROM `users` WHERE `ref`='".$user['id']."'");
										while($row_kol_ref2_kk = mysqli_fetch_assoc($sql_kol_ref2_kk)) {
											$user_ref2c_kk = mysqli_fetch_array(mysqli_query($mysqli, "select COUNT(*) as `count` from `users` where `ref`='".$row_kol_ref2_kk['id']."'"));
											$row_tovar_num += $user_ref2c_kk['count'];
										}									
									}
									
									echo '<p class="tx-12 mg-b-15">Всего рефералов ';
										if(!$_GET['id'] or $_GET['id'] == 1) { echo ' 1 уровня'; }
										else if($_GET['id'] == 2) { echo ' 2 уровня'; }
									echo ': '.$row_tovar_num .' чел.</p>';
									
									$num = 20;
									$page = $_GET['page'];
									$posts = $row_tovar_num;
									$total = intval(($posts - 1) / $num) + 1;
									$page = intval($page);
									if(empty($page) or $page < 0) $page = 1;  
									if($page > $total) $page = $total;
									$start = $page * $num - $num;
									
							?>
									<table class="table">
										<tr>
											<th>Логин</th>
											<th>Регистрация</th>
											<th>Последний раз был</th>
											<th>Заработано, руб.</th>
										</tr>
										<?php
											if(!$_GET['id'] or $_GET['id'] == 1) {
												$sql_ref_users = mysqli_query($mysqli, "SELECT `id`, `login`, `date_reg`, `date_vh` FROM `users` WHERE `ref`='".$user['id']."' LIMIT $start, $num");
											} else if($_GET['id'] == 2) {
												$sql_ref_users = mysqli_query($mysqli, "SELECT u2.id, u2.login, u2.date_reg, u2.date_vh FROM users u1 LEFT JOIN users u2 ON u2.ref = u1.id WHERE u1.ref = '".$user['id']."' and u2.id != 'NULL' LIMIT $start, $num");
											}
											while($row_ref_users = mysqli_fetch_assoc($sql_ref_users)) {
												
												if(!$_GET['id']) {
													$r_doh = mysqli_query($mysqli, "select SUM(`money`) as `sum` from `dvizh` where `info`='Начислено с реферала 1 уровня' and `id_users` = '".$user['id']."' and `otkogo`='".$row_ref_users['id']."'");
												} else if($_GET['id'] == 1) {
													$r_doh = mysqli_query($mysqli, "select SUM(`money`) as `sum` from `dvizh` where `info`='Начислено с реферала 1 уровня (серфинг)' and `id_users` = '".$user['id']."' and `otkogo`='".$row_ref_users['id']."'");
												} else if($_GET['id'] == 2) {
													$r_doh = mysqli_query($mysqli, "select SUM(`money`) as `sum` from `dvizh` where `info`='Начислено с реферала 2 уровня' and `id_users` = '".$user['id']."' and `otkogo`='".$row_ref_users['id']."'");
												}
												
												$a_doh = mysqli_fetch_array($r_doh);
												
										?>																
											<tr>
												<th><?php echo $row_ref_users['login']; ?></th>
												<td><?php echo date_format(date_create($row_ref_users['date_reg']), 'd.m.Y в H:i'); ?></td>
												<td><?php echo date_format(date_create($row_ref_users['date_vh']), 'd.m.Y в H:i'); ?></td>
												<td><?php if($a_doh['sum'] > 0) { echo number_format($a_doh['sum'], 4, '.', ' '); } else { echo '0'; } ?></td>
											</tr>
										<?php } ?>													
									</table>
													
									<?php if($ref_users_kol > $num) { ?>
										<div class="ht-80 bd d-flex align-items-center justify-content-center">
											 <nav aria-label="Page navigation">
												<ul class="pagination pagination-basic mg-b-0">
													<?php
													
														if($_GET['id']) {
															$pid = '&id='.$_GET['id'];
														} else { $pid = ''; }
													
														if($page != 1) {
															$pervpage = '
																<li class="page-item"><a class="page-link" href="ref.php?page=1'.$pid.'"><i class="fa fa-angle-double-left"></i></a></li>
																<li class="page-item"><a class="page-link" href="ref.php?page='.($page-1).''.$pid.'"><i class="fa fa-angle-left"></i></a></li>
															';
														}
														if($page != $total) {
															$nextpage = '
																<li class="page-item"><a class="page-link" href="ref.php?page='.($page+1).''.$pid.'"><i class="fa fa-angle-right"></i></a></li>
																<li class="page-item"><a class="page-link" href="ref.php?page='.$total.''.$pid.'"><i class="fa fa-angle-double-right"></i></a></li>
															';
														}
														if($page - 2 > 0) {
															$page2left = '<li class="page-item"><a class="page-link" href="ref.php?page='.($page-2).''.$pid.'">'.($page-2) .'</a></li>';
														}
														if($page - 1 > 0) {
															$page1left = '<li class="page-item"><a class="page-link" href="ref.php?page='.($page-1).''.$pid.'">'.($page-1).'</a></li>'; 
														}
														if($page + 2 <= $total) {
															$page2right = '<li class="page-item"><a class="page-link" href="ref.php?page='.($page+2).''.$pid.'">'.($page+2).'</a></li>';
														}
														if($page + 1 <= $total) {
															$page1right = '<li class="page-item"><a class="page-link" href="ref.php?page='.($page+1).''.$pid.'">'.($page+1).'</a></li>';
														}
														echo $pervpage.$page2left.$page1left.'<li class="page-item active"><a class="page-link">'.$page.'</a></li>'.$page1right.$page2right.$nextpage;
													?>
												</ul>
											</nav>
										</div>
									<?php } ?>
												
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