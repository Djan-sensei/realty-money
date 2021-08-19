<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban`, `money_pok`, `money_viv` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
	
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
	
	/*************** Постройка 1 ***************/
	
		$user_mat1 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='1' and `id_users`='".$user['id']."'"));
		$user_mat1d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='1'"));
		
		$kol_an1 = ($user_mat1d['speed']*0.9)*$user_mat1['kol'];

		$datm_an1 = date_create($user_mat1['start']);
		$dat1_an1 = date_create(date("Y-m-d H:i:s"));
		$interval_an1 = date_diff($datm_an1, $dat1_an1);

		$p_hours_an1 = $interval_an1->format('%H');
		$p_day_an1 = $interval_an1->format('%d');
		$p_month_an1 = $interval_an1->format('%m');
		
		$day_an1 = round(($p_hours_an1 + ($p_day_an1*24) + ($p_month_an1*740)));
		$nach_an1 = ($p_hours_an1 + ($p_day_an1*24) + ($p_month_an1*740))*$kol_an1;
		$nach_an1 = $nach_an1*0.90;
		$nach_an1 = round($nach_an1, 4);

		$d_dob_an1 = new DateTime($user_mat1['start']);
		$d_dob_an1->modify("+".$day_an1." hour");
		$datjk_an1 = $d_dob_an1->format("Y-m-d H:i:s");
		
		if($nach_an1 > 0) {
			$sql_day_bk_an1 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an1 ."', `sob`=`sob`+'".$nach_an1."' WHERE `id`='".$user_mat1['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 1 ***************/
	
	
	/*************** Постройка 2 ***************/
	
		$user_mat2 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='2' and `id_users`='".$user['id']."'"));
		$user_mat2d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='2'"));
		
		$kol_an2 = ($user_mat2d['speed']*0.9)*$user_mat2['kol'];

		$datm_an2 = date_create($user_mat2['start']);
		$dat1_an2 = date_create(date("Y-m-d H:i:s"));
		$interval_an2 = date_diff($datm_an2, $dat1_an2);

		$p_hours_an2 = $interval_an2->format('%H');
		$p_day_an2 = $interval_an2->format('%d');
		$p_month_an2 = $interval_an2->format('%m');
		
		$day_an2 = round(($p_hours_an2 + ($p_day_an2*24) + ($p_month_an2*740)));
		$nach_an2 = ($p_hours_an2 + ($p_day_an2*24) + ($p_month_an2*740))*$kol_an2;
		$nach_an2 = $nach_an2*0.90;
		$nach_an2 = round($nach_an2, 4);

		$d_dob_an2 = new DateTime($user_mat2['start']);
		$d_dob_an2->modify("+".$day_an2." hour");
		$datjk_an2 = $d_dob_an2->format("Y-m-d H:i:s");
		
		if($nach_an2 > 0) {
			$sql_day_bk_an2 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an2 ."', `sob`=`sob`+'".$nach_an2."' WHERE `id`='".$user_mat2['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 2 ***************/
	
	
	/*************** Постройка 3 ***************/
	
		$user_mat3 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='3' and `id_users`='".$user['id']."'"));
		$user_mat3d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='3'"));
		
		$kol_an3 = ($user_mat3d['speed']*0.9)*$user_mat3['kol'];

		$datm_an3 = date_create($user_mat3['start']);
		$dat1_an3 = date_create(date("Y-m-d H:i:s"));
		$interval_an3 = date_diff($datm_an3, $dat1_an3);

		$p_hours_an3 = $interval_an3->format('%H');
		$p_day_an3 = $interval_an3->format('%d');
		$p_month_an3 = $interval_an3->format('%m');
		
		$day_an3 = round(($p_hours_an3 + ($p_day_an3*24) + ($p_month_an3*740)));
		$nach_an3 = ($p_hours_an3 + ($p_day_an3*24) + ($p_month_an3*740))*$kol_an3;
		$nach_an3 = $nach_an3*0.90;
		$nach_an3 = round($nach_an3, 4);

		$d_dob_an3 = new DateTime($user_mat3['start']);
		$d_dob_an3->modify("+".$day_an3." hour");
		$datjk_an3 = $d_dob_an3->format("Y-m-d H:i:s");
		
		if($nach_an3 > 0) {
			$sql_day_bk_an3 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an3 ."', `sob`=`sob`+'".$nach_an3."' WHERE `id`='".$user_mat3['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 3 ***************/
	
	
	/*************** Постройка 4 ***************/
	
		$user_mat4 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='4' and `id_users`='".$user['id']."'"));
		$user_mat4d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='4'"));
		
		$kol_an4 = ($user_mat4d['speed']*0.9)*$user_mat4['kol'];

		$datm_an4 = date_create($user_mat4['start']);
		$dat1_an4 = date_create(date("Y-m-d H:i:s"));
		$interval_an4 = date_diff($datm_an4, $dat1_an4);

		$p_hours_an4 = $interval_an4->format('%H');
		$p_day_an4 = $interval_an4->format('%d');
		$p_month_an4 = $interval_an4->format('%m');
		
		$day_an4 = round(($p_hours_an4 + ($p_day_an4*24) + ($p_month_an4*740)));
		$nach_an4 = ($p_hours_an4 + ($p_day_an4*24) + ($p_month_an4*740))*$kol_an4;
		$nach_an4 = $nach_an4*0.90;
		$nach_an4 = round($nach_an4, 4);

		$d_dob_an4 = new DateTime($user_mat4['start']);
		$d_dob_an4->modify("+".$day_an4." hour");
		$datjk_an4 = $d_dob_an4->format("Y-m-d H:i:s");
		
		if($nach_an4 > 0) {
			$sql_day_bk_an4 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an4 ."', `sob`=`sob`+'".$nach_an4."' WHERE `id`='".$user_mat4['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 4 ***************/
	
	
	/*************** Постройка 5 ***************/
	
		$user_mat5 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='5' and `id_users`='".$user['id']."'"));
		$user_mat5d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='5'"));
		
		$kol_an5 = ($user_mat5d['speed']*0.9)*$user_mat5['kol'];

		$datm_an5 = date_create($user_mat5['start']);
		$dat1_an5 = date_create(date("Y-m-d H:i:s"));
		$interval_an5 = date_diff($datm_an5, $dat1_an5);

		$p_hours_an5 = $interval_an5->format('%H');
		$p_day_an5 = $interval_an5->format('%d');
		$p_month_an5 = $interval_an5->format('%m');
		
		$day_an5 = round(($p_hours_an5 + ($p_day_an5*24) + ($p_month_an5*740)));
		$nach_an5 = ($p_hours_an5 + ($p_day_an5*24) + ($p_month_an5*740))*$kol_an5;
		$nach_an5 = $nach_an5*0.90;
		$nach_an5 = round($nach_an5, 4);

		$d_dob_an5 = new DateTime($user_mat5['start']);
		$d_dob_an5->modify("+".$day_an5." hour");
		$datjk_an5 = $d_dob_an5->format("Y-m-d H:i:s");
		
		if($nach_an5 > 0) {
			$sql_day_bk_an5 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an5 ."', `sob`=`sob`+'".$nach_an5."' WHERE `id`='".$user_mat5['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 5 ***************/
	
	
	/*************** Постройка 6 ***************/
	
		$user_mat6 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='6' and `id_users`='".$user['id']."'"));
		$user_mat6d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='6'"));
		
		$kol_an6 = ($user_mat6d['speed']*0.9)*$user_mat6['kol'];

		$datm_an6 = date_create($user_mat6['start']);
		$dat1_an6 = date_create(date("Y-m-d H:i:s"));
		$interval_an6 = date_diff($datm_an6, $dat1_an6);

		$p_hours_an6 = $interval_an6->format('%H');
		$p_day_an6 = $interval_an6->format('%d');
		$p_month_an6 = $interval_an6->format('%m');
		
		$day_an6 = round(($p_hours_an6 + ($p_day_an6*24) + ($p_month_an6*740)));
		$nach_an6 = ($p_hours_an6 + ($p_day_an6*24) + ($p_month_an6*740))*$kol_an6;
		$nach_an6 = $nach_an6*0.90;
		$nach_an6 = round($nach_an6, 4);

		$d_dob_an6 = new DateTime($user_mat6['start']);
		$d_dob_an6->modify("+".$day_an6." hour");
		$datjk_an6 = $d_dob_an6->format("Y-m-d H:i:s");
		
		if($nach_an6 > 0) {
			$sql_day_bk_an6 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an6 ."', `sob`=`sob`+'".$nach_an6."' WHERE `id`='".$user_mat6['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 6 ***************/
	
	
	/*************** Постройка 7 ***************/
	
		$user_mat7 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='7' and `id_users`='".$user['id']."'"));
		$user_mat7d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='7'"));
		
		$kol_an7 = ($user_mat7d['speed']*0.9)*$user_mat7['kol'];

		$datm_an7 = date_create($user_mat7['start']);
		$dat1_an7 = date_create(date("Y-m-d H:i:s"));
		$interval_an7 = date_diff($datm_an7, $dat1_an7);

		$p_hours_an7 = $interval_an7->format('%H');
		$p_day_an7 = $interval_an7->format('%d');
		$p_month_an7 = $interval_an7->format('%m');
		
		$day_an7 = round(($p_hours_an7 + ($p_day_an7*24) + ($p_month_an7*740)));
		$nach_an7 = ($p_hours_an7 + ($p_day_an7*24) + ($p_month_an7*740))*$kol_an7;
		$nach_an7 = $nach_an7*0.90;
		$nach_an7 = round($nach_an7, 4);

		$d_dob_an7 = new DateTime($user_mat7['start']);
		$d_dob_an7->modify("+".$day_an7." hour");
		$datjk_an7 = $d_dob_an7->format("Y-m-d H:i:s");
		
		if($nach_an7 > 0) {
			$sql_day_bk_an7 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an7 ."', `sob`=`sob`+'".$nach_an7."' WHERE `id`='".$user_mat7['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 7 ***************/
	
	
	/*************** Постройка 8 ***************/
	
		$user_mat8 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='8' and `id_users`='".$user['id']."'"));
		$user_mat8d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='8'"));
		
		$kol_an8 = ($user_mat8d['speed']*0.9)*$user_mat8['kol'];

		$datm_an8 = date_create($user_mat8['start']);
		$dat1_an8 = date_create(date("Y-m-d H:i:s"));
		$interval_an8 = date_diff($datm_an8, $dat1_an8);

		$p_hours_an8 = $interval_an8->format('%H');
		$p_day_an8 = $interval_an8->format('%d');
		$p_month_an8 = $interval_an8->format('%m');
		
		$day_an8 = round(($p_hours_an8 + ($p_day_an8*24) + ($p_month_an8*740)));
		$nach_an8 = ($p_hours_an8 + ($p_day_an8*24) + ($p_month_an8*740))*$kol_an8;
		$nach_an8 = $nach_an8*0.90;
		$nach_an8 = round($nach_an8, 4);

		$d_dob_an8 = new DateTime($user_mat8['start']);
		$d_dob_an8->modify("+".$day_an8." hour");
		$datjk_an8 = $d_dob_an8->format("Y-m-d H:i:s");
		
		if($nach_an8 > 0) {
			$sql_day_bk_an8 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an8 ."', `sob`=`sob`+'".$nach_an8."' WHERE `id`='".$user_mat8['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 8 ***************/
	
	
	/*************** Постройка 9 ***************/
	
		$user_mat9 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='9' and `id_users`='".$user['id']."'"));
		$user_mat9d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='9'"));
		
		$kol_an9 = ($user_mat9d['speed']*0.9)*$user_mat9['kol'];

		$datm_an9 = date_create($user_mat9['start']);
		$dat1_an9 = date_create(date("Y-m-d H:i:s"));
		$interval_an9 = date_diff($datm_an9, $dat1_an9);

		$p_hours_an9 = $interval_an9->format('%H');
		$p_day_an9 = $interval_an9->format('%d');
		$p_month_an9 = $interval_an9->format('%m');
		
		$day_an9 = round(($p_hours_an9 + ($p_day_an9*24) + ($p_month_an9*740)));
		$nach_an9 = ($p_hours_an9 + ($p_day_an9*24) + ($p_month_an9*740))*$kol_an9;
		$nach_an9 = $nach_an9*0.90;
		$nach_an9 = round($nach_an9, 4);

		$d_dob_an9 = new DateTime($user_mat9['start']);
		$d_dob_an9->modify("+".$day_an9." hour");
		$datjk_an9 = $d_dob_an9->format("Y-m-d H:i:s");
		
		if($nach_an9 > 0) {
			$sql_day_bk_an9 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an9 ."', `sob`=`sob`+'".$nach_an9."' WHERE `id`='".$user_mat9['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 9 ***************/
	
	
	/*************** Постройка 10 ***************/
	
		$user_mat10 = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `sob`, `kol`, `start` from `users_mat` where `id_mat`='10' and `id_users`='".$user['id']."'"));
		$user_mat10d = mysqli_fetch_array(mysqli_query($mysqli, "select `speed` from `mat` where `id`='10'"));
		
		$kol_an10 = ($user_mat10d['speed']*0.9)*$user_mat10['kol'];

		$datm_an10 = date_create($user_mat10['start']);
		$dat1_an10 = date_create(date("Y-m-d H:i:s"));
		$interval_an10 = date_diff($datm_an10, $dat1_an10);

		$p_hours_an10 = $interval_an10->format('%H');
		$p_day_an10 = $interval_an10->format('%d');
		$p_month_an10 = $interval_an10->format('%m');
		
		$day_an10 = round(($p_hours_an10 + ($p_day_an10*24) + ($p_month_an10*740)));
		$nach_an10 = ($p_hours_an10 + ($p_day_an10*24) + ($p_month_an10*740))*$kol_an10;
		$nach_an10 = $nach_an10*0.90;
		$nach_an10 = round($nach_an10, 4);

		$d_dob_an10 = new DateTime($user_mat10['start']);
		$d_dob_an10->modify("+".$day_an10." hour");
		$datjk_an10 = $d_dob_an10->format("Y-m-d H:i:s");
		
		if($nach_an10 > 0) {
			$sql_day_bk_an10 = mysqli_query($mysqli, "UPDATE `users_mat` SET `start`='". $datjk_an10 ."', `sob`=`sob`+'".$nach_an10."' WHERE `id`='".$user_mat10['id']."'");
			echo '<script type="text/javascript"> top.window.location.href="mat.php"; </script>';
			exit;
		}
	
	/*************** [end]Постройка 10 ***************/
	
	
	$sbor = $user_mat1['sob'] + $user_mat2['sob'] + $user_mat3['sob'] + $user_mat4['sob'] + $user_mat5['sob'] + $user_mat6['sob'] + $user_mat7['sob'] + $user_mat8['sob'] + $user_mat9['sob'] + $user_mat10['sob'];
	
	$prib = $kol_an1 + $kol_an2 + $kol_an3 + $kol_an4 + $kol_an5 + $kol_an6 + $kol_an7 + $kol_an8 + $kol_an9 + $kol_an10;
	
	$obnov = mysqli_fetch_array(mysqli_query($mysqli, "select `start` from `users_mat` where `id_users`='".$user['id']."' ORDER by `start` ASC LIMIT 0,1"));
	
	$ddp = new DateTime($obnov['start']);
	$ddp->modify("+1 hour");
	$datn_ob = $ddp->format("Y-m-d H:i:s");
	$dat2_ob = date_create($datn_ob);
	$dat1_ob = date_create(date("Y-m-d H:i:s"));
	$interval_ob = date_diff($dat2_ob, $dat1_ob);
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Недвижимость</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    <div class="am-mainpanel">
		
		<div class="am-pagetitle">
			<h5 class="am-title">Недвижимость</h5>
		</div>

		<div class="am-pagebody">       
			<div class="row row-sm">
			
				
			
				<div class="col-lg-12 mg-t-15 mg-sm-t-20">
					<div class="card pd-20">
						<p class="tx-12 mg-b-10">Прибыль начисляется автоматически, каждый час.<br>Как только накопится 0.01 руб, можно будет снять деньги.</p>
						<p class="tx-lato tx-inverse tx-bold">Доступно: <code class="tx-20"><?php echo round($sbor, 4); ?></code> руб.</p>
						<p class="tx-12 mg-b-10">Следующий сбор прибыли через: <span id="tmpt"><?php echo $interval_ob->format('%H:%i:%s'); ?></span></p>
						<script>
							function tmpt() {
								var time = document.getElementById("tmpt");
								var times = time.innerHTML;
								var arr = times.split(":");
								var h = arr[0];
								var m = arr[1];
								var s = arr[2];
								if (s == 0) {
									if (m == 0) {
										if (h == 0) {
											window.location.reload();
											return;
										}
										h--;
										m = 60;
										if (h < 10) h = "0" + h;
									}
									m--;
									if (m < 10) m = "0" + m;
									s = 59;
								}
								else s--;
								if (s < 10) s = "0" + s;
								document.getElementById("tmpt").innerHTML = h+":"+m+":"+s;																
								setTimeout(tmpt, 1000);
							} tmpt();
						</script>
					</div>
				</div>
			
				<iframe name="Frame" style="display:none;"></iframe>
				<?php
					$sql_n = mysqli_query($mysqli, "SELECT * FROM `mat` ORDER by `id` ASC");
					while($row_n = mysqli_fetch_assoc($sql_n)) {
						$user_mat = mysqli_fetch_array(mysqli_query($mysqli, "select `id`, `kol`, `sob` from `users_mat` where `id_mat` = '".$row_n['id']."' and `id_users`='".$user['id']."'"));
				?>			
					<div class="col-lg-3 col-md-4 col-sm-6 mg-t-15 mg-sm-t-20">
						<div class="card">
							<div class="pd-20"><h6 class="tx-inverse tx-14"><?php echo $row_n['name']; ?> (<?php echo 0+$user_mat['kol']; ?> шт.)</h6></div>
							<div class="pd-10" style="overflow:hidden; text-align:center;"><img style="max-width:150px; width:100%; height:auto;" src="<?php echo $row_n['img']; ?>"></div>
							<div class="pd-20">
								<p class="tx-13 mg-b-0"><b>Доходность:</b> <?php echo $row_n['dohod']; ?>% / мес.</p>
								<p class="tx-13"><b>Прибыль:</b> <code><?php echo $row_n['speed']; ?>руб./час</code></p>
								<form accept-charset="utf-8" action="" method="post" target="Frame">
									<div class="d-flex">									
										<input type="submit" name="buy_<?php echo $row_n['id'];?>" style="margin:0 auto; cursor:pointer;" class="btn btn-info" value="Купить за <?php echo number_format($row_n['price'], 0, '', ' '); ?> руб.">
										<?php
											$buy = 'buy_'.$row_n['id'];
											if(isset($_POST[$buy])) {
												if($user['money_pok'] >= $row_n['price']) {
													$mon = round(($user['money_pok']-$row_n['price']), 4);
													$mmin = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`='".$mon."' WHERE `id`='".$user['id']."'") or die(mysqli_error());
													if(!$user_mat['id']) {
														mysqli_query($mysqli, "INSERT INTO `users_mat` (`id_users`, `id_mat`, `kol`, `start`) VALUES ('".$user['id']."', '".$row_n['id']."', '1', '". date('Y-m-d H:i:s') ."') ") or die(mysqli_error());
													} else {
														mysqli_query($mysqli, "UPDATE `users_mat` SET `kol`=`kol`+1 WHERE `id_users`='".$user['id']."' and `id_mat`='".$row_n['id']."'") or die(mysqli_error());
													}
													echo '<script type="text/javascript">top.alert("Успешно!"); top.window.location.href="mat.php";</script>';
												} else {
													echo '<script type="text/javascript">top.alert("Не хватает денег!");</script>';
												}
											}
										?>										
									</div>
								</form>
							</div>
							<?php if($user_mat['sob'] >= 0.01) { ?>
								<div class="pd-b-20">
									<form accept-charset="utf-8" action="" method="post" target="Frame">
										<div class="d-flex">									
											<input type="submit" name="cnt_<?php echo $row_n['id'];?>" style="margin:0 auto; cursor:pointer;" class="btn btn-success" value="Снять <?php echo round($user_mat['sob'], 4); ?> руб.">
											<?php
												$cnt = 'cnt_'.$row_n['id'];
												if(isset($_POST[$cnt])) {	
												
													$mon_pr = $user['money_viv'] + round($user_mat['sob'], 4);
													$mon_pr = round($mon_pr, 4);
													
													$mon_min = $user_mat['sob'] - round($user_mat['sob'], 4);
													$mon_min = abs($mon_min);
													
													$mmin1 = mysqli_query($mysqli, "UPDATE `users_mat` SET `sob`='".$mon_min."' WHERE `id`='".$user_mat['id']."'") or die(mysqli_error());
													
													$mmin2 = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`='".$mon_pr."' WHERE `id`='".$user['id']."'") or die(mysqli_error());
													
													echo '<script type="text/javascript">top.alert("Успешно!"); top.window.location.href="mat.php";</script>';													
												}
											?>										
										</div>
									</form>
								</div>
							<?php } ?>
						</div>
					</div>			  
				<?php } ?>
			</div>       
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
	
</body>
</html>