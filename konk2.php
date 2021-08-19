<?php
	include('mysql.php');
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
	$konk = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `konk` WHERE `end`='0' and `type`='2'"));
	
	if(date('Y-m-d H:i:s') >= $konk['finish'] and $konk['id']) {
		
		// Начисление призов
		$x=0;
		$sql_n = mysqli_query($mysqli, "SELECT *, SUM(`money`) as `sum` FROM `users_money` WHERE `date`>='".$konk['start']."' GROUP by `id_users` ORDER by `sum` DESC LIMIT 0,3");
		while($row_n = mysqli_fetch_assoc($sql_n)) {
			$x++;
			// 1 место
			if($x == 1) { $mon1 = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`=`money_viv`+'".$konk['priz1']."' WHERE `id`='".$row_n['id_users']."'") or die(mysqli_error()); $pob1 = $row_n['id_users']; }
			// 2 место
			else if($x == 2) { $mon2 = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`=`money_viv`+'".$konk['priz2']."' WHERE `id`='".$row_n['id_users']."'") or die(mysqli_error()); $pob2 = $row_n['id_users']; }
			// 3 место
			else if($x == 3) { $mon3 = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`=`money_viv`+'".$konk['priz3']."' WHERE `id`='".$row_n['id_users']."'") or die(mysqli_error()); $pob3 = $row_n['id_users']; }
		}
		
		$end = mysqli_query($mysqli, "UPDATE `konk` SET `end`='1', `pob1`='".$pob1."', `pob2`='".$pob2."', `pob3`='".$pob3."' WHERE `id`='".$konk['id']."'") or die(mysqli_error());
		
		echo '<script type="text/javascript">window.location.href="konk1.php";</script>';
		
		exit;
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Конкурс инвесторов</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    

    <div class="am-mainpanel">
		<div class="am-pagetitle">
			<h5 class="am-title">Конкурс инвесторов</h5>
		</div>

		<div class="am-pagebody">
		
			<?php if($konk['id']) { ?>
				<div class="row row-sm">
					<div class="col-lg-12">
						<div class="card pd-20">
							<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Конкурс инвесторов №<?php echo $konk['id']; ?> с призовым фондом <?php echo $konk['priz1']+$konk['priz2']+$konk['priz3']; ?> руб.</h6>
							<p class="mg-b-20 mg-sm-b-30">В конкурсе учитываются все пополнения баланса, совершенные после запуска конкурса. За каждое пополнение баланса Вы увеличиваете шанс выигрыша!</p>
							<p class="mg-b-20 mg-sm-b-30">
								<b>1-место:</b> <?php echo $konk['priz1']; ?> руб.<br>
								<b>2-место:</b> <?php echo $konk['priz2']; ?> руб.<br>
								<b>3-место:</b> <?php echo $konk['priz3']; ?> руб.
							</p>
							<p class="mg-b-20 mg-sm-b-30" align="center">
								<b>Старт конкурса:</b> <?php echo date_format(date_create($konk['start']), 'd.m.Y в H:i'); ?>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								<b>Завершение:</b> <?php echo date_format(date_create($konk['finish']), 'd.m.Y в H:i'); ?>
							</p>
						</div>
					</div>
				</div>
				
				<div class="row row-sm mg-t-15 mg-sm-t-20">
					<div class="col-md-12">
						<div class="card pd-20 pd-sm-40">
							<h6 class="card-body-title">Таблица лидеров (ТОП 10)</h6>
							<p class="mg-b-20 mg-sm-b-30">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<th>Место</th>
											<th>Логин</th>
											<th>Сумма, руб.</th>
											<th>Приз, руб.</th>
										</tr>
										<?php
											$x=0;
											$sql_n = mysqli_query($mysqli, "SELECT *, SUM(`money`) as `sum` FROM `users_money` WHERE `date`>='".$konk['start']."' GROUP by `id_users` ORDER by `sum` DESC LIMIT 0,10");
											while($row_n = mysqli_fetch_assoc($sql_n)) {
												$x++;
												$user1 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `login` from `users` where `id`='".$row_n['id_users']."'"));
										?>	
												<tr>
													<td><?php echo $x;?></td>
													<td><?php echo $user1['login'];?></td>
													<td><?php echo $row_n['sum'];?></td>
													<td><?php
														if($x == 1) { echo $konk['priz1']; }
														else if($x == 2) { echo $konk['priz2']; }
														else if($x == 3) { echo $konk['priz3']; }
														else { echo '-'; }
													?></td>
												</tr>
										<?php } ?>
									</tbody>
								</table>
							</p>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="row row-sm">
					<div class="col-lg-12">
						<div class="card pd-20">
							<h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-15">Конкурс рефералов</h6>
							<p class="mg-b-20 mg-sm-b-30">Конкурс завершен! В ближайшее время появится новый.</p>
						</div>
					</div>
				</div>
			<?php } ?>
        
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>