<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$r_users = mysqli_query($mysqli, "select `id`, `money_pok` from `users` where `login` = '".$_SESSION['user']."' and `pass` = '".$_SESSION['pass']."'");
	$a = mysqli_fetch_array($r_users);

	$r_pokbank_proi = mysqli_query($mysqli, "select sum(`zoloto`) as `sum` from `poker_bank` where `result` = '0'");
	$a_pokbank_proi = mysqli_fetch_array($r_pokbank_proi);

	$r_pokbank_pob = mysqli_query($mysqli, "select sum(`zoloto`) as `sum` from `poker_bank` where `result` = '1'");
	$a_pokbank_pob = mysqli_fetch_array($r_pokbank_pob);

	$bank = round($a_pokbank_proi['sum'] - $a_pokbank_pob['sum']);
	$bank_pol = round($bank/2);

	$r_pok = mysqli_query($mysqli, "select * from `poker` where `id_users` = '".$a['id']."'");
	$a_pok = mysqli_fetch_array($r_pok);

	$r_cart1 = mysqli_query($mysqli, "select * from `carts` where `id` = '".$a_pok['cart1']."'");
	$a_cart1 = mysqli_fetch_array($r_cart1);

	$r_cart2 = mysqli_query($mysqli, "select * from `carts` where `id` = '".$a_pok['cart2']."'");
	$a_cart2 = mysqli_fetch_array($r_cart2);

	$r_cart3 = mysqli_query($mysqli, "select * from `carts` where `id` = '".$a_pok['cart3']."'");
	$a_cart3 = mysqli_fetch_array($r_cart3);

	$r_cart4 = mysqli_query($mysqli, "select * from `carts` where `id` = '".$a_pok['cart4']."'");
	$a_cart4 = mysqli_fetch_array($r_cart4);

	$r_cart5 = mysqli_query($mysqli, "select * from `carts` where `id` = '".$a_pok['cart5']."'");
	$a_cart5 = mysqli_fetch_array($r_cart5);

	for($i=0; $i<52; $i++) {
		$temp = rand(1,52);
		$flag = 1;
		$k = 0;
		while($flag == 1 && $k < $i) {
			if($mas[$k] == $temp) { $flag = 2; }
			$k++;
		}
		if($flag == 1) { $mas[$i] = $temp; }
	}
	sort($mas);

	$masdel1 = $a_pok['cart1']-1;
	$masdel2 = $a_pok['cart2']-1;
	$masdel3 = $a_pok['cart3']-1;
	$masdel4 = $a_pok['cart4']-1;
	$masdel5 = $a_pok['cart5']-1;
	$b = range(1,52,8);
	//shuffle($b);
	unset($b[$masdel1], $b[$masdel2], $b[$masdel3], $b[$masdel4], $b[$masdel5]);
	$smen_cart_old = $b[array_rand($b)];

	$arr = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52);
	while (($qm = array_search($a_pok['cart1'], $arr)) !== false) {
		unset($arr[$qm]);
	}
	while (($qm = array_search($a_pok['cart2'], $arr)) !== false) {
		unset($arr[$qm]);
	} 
	while (($qm = array_search($a_pok['cart3'], $arr)) !== false) {
		unset($arr[$qm]);
	} 
	while (($qm = array_search($a_pok['cart4'], $arr)) !== false) {
		unset($arr[$qm]);
	} 
	while (($qm = array_search($a_pok['cart5'], $arr)) !== false) {
		unset($arr[$qm]);
	}
	$smen_cart = $arr[array_rand($arr)];
	$rand_keys = array_rand($arr, 5);
	$smen_cart1 = $arr[$rand_keys[0]];
	$smen_cart2 = $arr[$rand_keys[1]];
	$smen_cart3 = $arr[$rand_keys[2]];
	$smen_cart4 = $arr[$rand_keys[3]];
	$smen_cart5 = $arr[$rand_keys[4]];

	/**** Кол-во одинаковых мастей ****/

	$mast1 = 0; $mast2 = 0; $mast3 = 0; $mast4 = 0;

	if($a_cart1['id_mast'] == 1) { $mast1_1 = 1; }
	else if($a_cart1['id_mast'] == 2) { $mast1_2 = 1; }
	else if($a_cart1['id_mast'] == 3) { $mast1_3 = 1; }
	else if($a_cart1['id_mast'] == 4) { $mast1_4 = 1; }

	if($a_cart2['id_mast'] == 1) { $mast2_1 = 1; }
	else if($a_cart2['id_mast'] == 2) { $mast2_2 = 1; }
	else if($a_cart2['id_mast'] == 3) { $mast2_3 = 1; }
	else if($a_cart2['id_mast'] == 4) { $mast2_4 = 1; }

	if($a_cart3['id_mast'] == 1) { $mast3_1 = 1; }
	else if($a_cart3['id_mast'] == 2) { $mast3_2 = 1; }
	else if($a_cart3['id_mast'] == 3) { $mast3_3 = 1; }
	else if($a_cart3['id_mast'] == 4) { $mast3_4 = 1; }

	if($a_cart4['id_mast'] == 1) { $mast4_1 = 1; }
	else if($a_cart4['id_mast'] == 2) { $mast4_2 = 1; }
	else if($a_cart4['id_mast'] == 3) { $mast4_3 = 1; }
	else if($a_cart4['id_mast'] == 4) { $mast4_4 = 1; }

	if($a_cart5['id_mast'] == 1) { $mast5_1 = 1; }
	else if($a_cart5['id_mast'] == 2) { $mast5_2 = 1; }
	else if($a_cart5['id_mast'] == 3) { $mast5_3 = 1; }
	else if($a_cart5['id_mast'] == 4) { $mast5_4 = 1; }

	// Млекопит
	$mast1 = $mast1_1 + $mast2_1 + $mast3_1 + $mast4_1 + $mast5_1;
	// Птицы
	$mast2 = $mast1_2 + $mast2_2 + $mast3_2 + $mast4_2 + $mast5_2;
	// Растения
	$mast3 = $mast1_3 + $mast2_3 + $mast3_3 + $mast4_3 + $mast5_3;
	// Рыбы
	$mast4 = $mast1_4 + $mast2_4 + $mast3_4 + $mast4_4 + $mast5_4;

	/**** [end]Кол-во одинаковых мастей ****/

	/**** Кол-во одинаковых рангов ****/

	$rang1 = 0; $rang2 = 0; $rang3 = 0; $rang4 = 0; $rang5 = 0; $rang6 = 0; $rang7 = 0; $rang8 = 0; $rang9 = 0; $rang10 = 0; $rang11 = 0; $rang12 = 0; $rang13 = 0;

	if($a_cart1['id_num'] == 1) { $rang1_1 = 1; }
	else if($a_cart1['id_num'] == 2) { $rang1_2 = 1; }
	else if($a_cart1['id_num'] == 3) { $rang1_3 = 1; }
	else if($a_cart1['id_num'] == 4) { $rang1_4 = 1; }
	else if($a_cart1['id_num'] == 5) { $rang1_5 = 1; }
	else if($a_cart1['id_num'] == 6) { $rang1_6 = 1; }
	else if($a_cart1['id_num'] == 7) { $rang1_7 = 1; }
	else if($a_cart1['id_num'] == 8) { $rang1_8 = 1; }
	else if($a_cart1['id_num'] == 9) { $rang1_9 = 1; }
	else if($a_cart1['id_num'] == 10) { $rang1_10 = 1; }
	else if($a_cart1['id_num'] == 11) { $rang1_11 = 1; }
	else if($a_cart1['id_num'] == 12) { $rang1_12 = 1; }
	else if($a_cart1['id_num'] == 13) { $rang1_13 = 1; }

	if($a_cart2['id_num'] == 1) { $rang2_1 = 1; }
	else if($a_cart2['id_num'] == 2) { $rang2_2 = 1; }
	else if($a_cart2['id_num'] == 3) { $rang2_3 = 1; }
	else if($a_cart2['id_num'] == 4) { $rang2_4 = 1; }
	else if($a_cart2['id_num'] == 5) { $rang2_5 = 1; }
	else if($a_cart2['id_num'] == 6) { $rang2_6 = 1; }
	else if($a_cart2['id_num'] == 7) { $rang2_7 = 1; }
	else if($a_cart2['id_num'] == 8) { $rang2_8 = 1; }
	else if($a_cart2['id_num'] == 9) { $rang2_9 = 1; }
	else if($a_cart2['id_num'] == 10) { $rang2_10 = 1; }
	else if($a_cart2['id_num'] == 11) { $rang2_11 = 1; }
	else if($a_cart2['id_num'] == 12) { $rang2_12 = 1; }
	else if($a_cart2['id_num'] == 13) { $rang2_13 = 1; }

	if($a_cart3['id_num'] == 1) { $rang3_1 = 1; }
	else if($a_cart3['id_num'] == 2) { $rang3_2 = 1; }
	else if($a_cart3['id_num'] == 3) { $rang3_3 = 1; }
	else if($a_cart3['id_num'] == 4) { $rang3_4 = 1; }
	else if($a_cart3['id_num'] == 5) { $rang3_5 = 1; }
	else if($a_cart3['id_num'] == 6) { $rang3_6 = 1; }
	else if($a_cart3['id_num'] == 7) { $rang3_7 = 1; }
	else if($a_cart3['id_num'] == 8) { $rang3_8 = 1; }
	else if($a_cart3['id_num'] == 9) { $rang3_9 = 1; }
	else if($a_cart3['id_num'] == 10) { $rang3_10 = 1; }
	else if($a_cart3['id_num'] == 11) { $rang3_11 = 1; }
	else if($a_cart3['id_num'] == 12) { $rang3_12 = 1; }
	else if($a_cart3['id_num'] == 13) { $rang3_13 = 1; }

	if($a_cart4['id_num'] == 1) { $rang4_1 = 1; }
	else if($a_cart4['id_num'] == 2) { $rang4_2 = 1; }
	else if($a_cart4['id_num'] == 3) { $rang4_3 = 1; }
	else if($a_cart4['id_num'] == 4) { $rang4_4 = 1; }
	else if($a_cart4['id_num'] == 5) { $rang4_5 = 1; }
	else if($a_cart4['id_num'] == 6) { $rang4_6 = 1; }
	else if($a_cart4['id_num'] == 7) { $rang4_7 = 1; }
	else if($a_cart4['id_num'] == 8) { $rang4_8 = 1; }
	else if($a_cart4['id_num'] == 9) { $rang4_9 = 1; }
	else if($a_cart4['id_num'] == 10) { $rang4_10 = 1; }
	else if($a_cart4['id_num'] == 11) { $rang4_11 = 1; }
	else if($a_cart4['id_num'] == 12) { $rang4_12 = 1; }
	else if($a_cart4['id_num'] == 13) { $rang4_13 = 1; }

	if($a_cart5['id_num'] == 1) { $rang5_1 = 1; }
	else if($a_cart5['id_num'] == 2) { $rang5_2 = 1; }
	else if($a_cart5['id_num'] == 3) { $rang5_3 = 1; }
	else if($a_cart5['id_num'] == 4) { $rang5_4 = 1; }
	else if($a_cart5['id_num'] == 5) { $rang5_5 = 1; }
	else if($a_cart5['id_num'] == 6) { $rang5_6 = 1; }
	else if($a_cart5['id_num'] == 7) { $rang5_7 = 1; }
	else if($a_cart5['id_num'] == 8) { $rang5_8 = 1; }
	else if($a_cart5['id_num'] == 9) { $rang5_9 = 1; }
	else if($a_cart5['id_num'] == 10) { $rang5_10 = 1; }
	else if($a_cart5['id_num'] == 11) { $rang5_11 = 1; }
	else if($a_cart5['id_num'] == 12) { $rang5_12 = 1; }
	else if($a_cart5['id_num'] == 13) { $rang5_13 = 1; }

	$rang1 = $rang1_1 + $rang2_1 + $rang3_1 + $rang4_1 + $rang5_1; // 2
	$rang2 = $rang1_2 + $rang2_2 + $rang3_2 + $rang4_2 + $rang5_2; // 3
	$rang3 = $rang1_3 + $rang2_3 + $rang3_3 + $rang4_3 + $rang5_3; // 4
	$rang4 = $rang1_4 + $rang2_4 + $rang3_4 + $rang4_4 + $rang5_4; // 5
	$rang5 = $rang1_5 + $rang2_5 + $rang3_5 + $rang4_5 + $rang5_5; // 6
	$rang6 = $rang1_6 + $rang2_6 + $rang3_6 + $rang4_6 + $rang5_6; // 7
	$rang7 = $rang1_7 + $rang2_7 + $rang3_7 + $rang4_7 + $rang5_7; // 8
	$rang8 = $rang1_8 + $rang2_8 + $rang3_8 + $rang4_8 + $rang5_8; // 9
	$rang9 = $rang1_9 + $rang2_9 + $rang3_9 + $rang4_9 + $rang5_9; // 10
	$rang10 = $rang1_10 + $rang2_10 + $rang3_10 + $rang4_10 + $rang5_10; // валет
	$rang11 = $rang1_11 + $rang2_11 + $rang3_11 + $rang4_11 + $rang5_11; // дама
	$rang12 = $rang1_12 + $rang2_12 + $rang3_12 + $rang4_12 + $rang5_12; // король
	$rang13 = $rang1_13 + $rang2_13 + $rang3_13 + $rang4_13 + $rang5_13; // туз

	/**** [end]Кол-во одинаковых рангов ****/

	/**** Сумма рангов для 2 пар ****/
	if($rang1 == 2) { $sumr1 = 1; }
	if($rang2 == 2) { $sumr2 = 1; }
	if($rang3 == 2) { $sumr3 = 1; }
	if($rang4 == 2) { $sumr4 = 1; }
	if($rang5 == 2) { $sumr5 = 1; }
	if($rang6 == 2) { $sumr6 = 1; }
	if($rang7 == 2) { $sumr7 = 1; }
	if($rang8 == 2) { $sumr8 = 1; }
	if($rang9 == 2) { $sumr9 = 1; }
	if($rang10 == 2) { $sumr10 = 1; }
	if($rang11 == 2) { $sumr11 = 1; }
	if($rang12 == 2) { $sumr12 = 1; }
	if($rang13 == 2) { $sumr13 = 1; }

	$sumr = $sumr1 + $sumr2 + $sumr3 + $sumr4 + $sumr5 + $sumr6 + $sumr7 + $sumr8 + $sumr9 + $sumr10 + $sumr11 + $sumr12 + $sumr13;
	/**** [end]Сумма рангов для 2 пар ****/

	$mafd1[0] = $a_cart1['id_num'];
	$mafd1[1] = $a_cart2['id_num'];
	$mafd1[2] = $a_cart3['id_num'];
	$mafd1[3] = $a_cart4['id_num'];
	$mafd1[4] = $a_cart5['id_num'];
	sort($mafd1);

	$priz = 0;

	if( ($mafd1[4] == 13 and $mafd1[0] == 1) ) { $tuz1 = 1; } else { $tuz1 = $mafd1[0]; }
	if($a_cart1['id_num'] == 13) { $tuz0 = 1; } else { $tuz0 = $a_cart1['id_num']; }


	// РОЯЛ ФЛЕШ - Если 5 карт одной масти и ранг идет по старшинству от 10 до А
	if(
		($mafd1[0] == 9 and $mafd1[1] == 10 and $mafd1[2] == 11 and $mafd1[3] == 12 and $mafd1[4] == 13) and 
		($mast1 == 5 or $mast2 == 5 or $mast3 == 5 or $mast4 == 5)
	) {	
		$comb = 10;
		$priz = $a_pok['stavka']*200;
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// СТРИТ ФЛЕШ - Если 5 карт одной масти и ранг идет по старшинству (ранг +1)
	else if(
		($mafd1[1] == ($tuz1+1) and $mafd1[2] == ($mafd1[1]+1) and $mafd1[3] == ($mafd1[2]+1) and $mafd1[4] == ($mafd1[3]+1)) and 
		($mast1 == 5 or $mast2 == 5 or $mast3 == 5 or $mast4 == 5)
	) {	
		$comb = 9;
		$priz = $a_pok['stavka']*100;
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// КАРЕ или ПОКЕР ФЛЕШ - Если 4 карты одного ранга, любой масти
	else if(
		$rang1 == 4 or $rang2 == 4 or $rang3 == 4 or $rang4 == 4 or $rang5 == 4 or $rang6 == 4 or $rang7 == 4 or $rang8 == 4 or $rang9 == 4 or $rang10 == 4 or $rang11 == 4 or $rang12 == 4 or $rang13 == 4
	) {	
		$comb = 8;
		$priz = $a_pok['stavka']*50;
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// ФУЛ-ХАУС - Если 3 карты одного ранга и 2 карты другого ранга любой масти
	else if(
		($rang1 == 3 or $rang2 == 3 or $rang3 == 3 or $rang4 == 3 or $rang5 == 3 or $rang6 == 3 or $rang7 == 3 or $rang8 == 3 or $rang9 == 3 or $rang10 == 3 or $rang11 == 3 or $rang12 == 3 or $rang13 == 3) and 
		($rang1 == 2 or $rang2 == 2 or $rang3 == 2 or $rang4 == 2 or $rang5 == 2 or $rang6 == 2 or $rang7 == 2 or $rang8 == 2 or $rang9 == 2 or $rang10 == 2 or $rang11 == 2 or $rang12 == 2 or $rang13 == 2)
	) {	
		$comb = 7;
		$priz = $a_pok['stavka']*15;
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// ФЛЕШ - Если все 5 карт одной масти
	else if(
		$mast1 == 5 or $mast2 == 5 or $mast3 == 5 or $mast4 == 5
	) {	
		$comb = 6;
		$priz = $a_pok['stavka']*10;
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// СТРИТ - Если 5 карт разного ранга следуют друг за другом (ранг +1), не зависимо от масти, причем туз является как 1 так и старшей картой
	else if(
		$mafd1[1] == ($tuz1+1) and $mafd1[2] == ($mafd1[1]+1) and $mafd1[3] == ($mafd1[2]+1) and $mafd1[4] == ($mafd1[3]+1) and 
		($mast1 != 5 or $mast2 != 5 or $mast3 != 5 or $mast4 != 5)
	) {	
		$comb = 5;
		$priz = $a_pok['stavka']*5;
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// СЕТ - Если 3 карты имеют одинаковый ранг и любую масть
	else if(
		$rang1 == 3 or $rang2 == 3 or $rang3 == 3 or $rang4 == 3 or $rang5 == 3 or $rang6 == 3 or $rang7 == 3 or $rang8 == 3 or $rang9 == 3 or $rang10 == 3 or $rang11 == 3 or $rang12 == 3 or $rang13 == 3
	) {	
		$comb = 4;
		$priz = round($a_pok['stavka']*2.5);
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// ДВЕ ПАРЫ - Если 2 карты одного ранга и 2 карты другого ранга из 5 имеют одинаковый ранг и любую масть
	else if(
		$sumr == 2
	) {	
		$comb = 3;
		$priz = round($a_pok['stavka']*1.5);
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// ПАРА - Если 2 карты из 5 имеют одинаковый ранг и любую масть
	else if(
		$rang1 == 2 or $rang2 == 2 or $rang3 == 2 or $rang4 == 2 or $rang5 == 2 or $rang6 == 2 or $rang7 == 2 or $rang8 == 2 or $rang9 == 2 or $rang10 == 2 or $rang11 == 2 or $rang12 == 2 or $rang13 == 2
	) {	
		$comb = 2;
		$priz = round($a_pok['stavka']*0.5);
		if($bank_pol < $priz) {
			if($a_pok['zamena'] <= 0) {
				$ccart = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."' WHERE `id`='".$a_pok['id']."'");
				echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
				exit;
			}
		}
	}

	// НИЧЕГО
	else {	
		$comb = 1;
		$priz = 0;
	}

	if($a_pok['lot'] == 1) { include('cart1.php'); }
	else if($a_pok['lot'] == 2) { include('cart2.php'); }
	else if($a_pok['lot'] == 3) { include('cart3.php'); }
	else if($a_pok['lot'] == 4) { include('cart4.php'); }
	else if($a_pok['lot'] == 5) { include('cart5.php'); }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Покер</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    

    <div class="am-mainpanel">
		<div class="am-pagetitle">
			<h5 class="am-title">Покер</h5>
		</div>

		<div class="am-pagebody">
		
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card pd-20">
					
						<?php if($a['id'] == 1) {
						echo '<p>Проигрыши на сумму: <code>'.$a_pokbank_proi['sum'].'</code> Победы на сумму: <code>'.$a_pokbank_pob['sum'].'</code> Общий банк: <code>'.$bank.'</code></p>';
					} ?>
					
						
						
							<iframe name="Frame" style="display:none;"></iframe>
							<form accept-charset="utf-8" action="" method="post" target="Frame">
								
								
								
								
								<?php if(!$a_pok['id']) { ?>
					
						<p class="mg-b-20 mg-sm-b-30">Минимальная ставка: 10 руб.<br>Максимальная ставка: 10000 руб<br>Учитываются суммы на покупки.</p>
						
						<div class="row mg-b-25">
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Ставка в руб.: <span class="tx-danger">*</span></label>
									<input class="form-control" type="number" name="stavka" value="" placeholder="Ставка в руб." onkeyup="this.value = this.value.replace (/\D/gi, '').replace (/^0+/, '')">
								</div>
							</div>
						</div>
						
						<div class="form-layout-footer">
									<input type="submit" name="stav" style="margin:0 auto; cursor:pointer;" class="btn btn-success" value="Играть">
						</div>
						
						<?php
							if(isset($_POST['stav'])) {
								
								$stavka = mysqli_real_escape_string($mysqli, $_POST['stavka']);
								$stavka = strip_tags($stavka);
								$stavka = htmlspecialchars($stavka);
								$stavka = (int)$stavka;
								
								for($i=1; $i<52; $i++) {
									$temp = rand(1,52);
									$flag = 1;
									$k = 0;
									while($flag == 1 && $k < $i) {
										if($mas[$k] == $temp) { $flag = 2; }
										$k++;
									}
									if($flag == 1) { $mas[$i] = $temp; }
								}
								
								if($a['money_pok'] >= $stavka and $stavka >= 10 and $stavka <= 10000) {
									$sqlpok1 = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`=`money_pok`-'".$stavka."' WHERE `id`='".$a['id']."'");
									$sqlpok2 = mysqli_query($mysqli, "INSERT INTO `poker`(`id_users`, `date`, `stavka`, `cart1`, `cart2`, `cart3`, `cart4`, `cart5`) VALUES ('".$a['id']."', '". date("Y-m-d H:i:s") ."', '".$stavka."', '".$mas[0]."', '".$mas[1]."', '".$mas[2]."', '".$mas[3]."', '".$mas[4]."')");
									echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>';
								} else {
									echo '<script type="text/javascript"> top.alert("Не хватает денег!"); top.window.location.href="poker.php"; </script>';
								}
							}
						?>
						
						<br/><div class="table table-bordered">
							<table style="font-size:12px;">
								<thead>
									<tr>
										<th>Комбинация</th>
										<th>Описание</th>
										<th>Выигрыш</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Старшая карта</td>
										<td>одна старшая карта или любая комбинация отличная от других</td>
										<td>-</td>
									</tr>
									<tr>
										<td>Пара</td>
										<td>две из пяти карт одинакового ранга</td>
										<td>ставка*0,5</td>
									</tr>
									<tr>
										<td>Две пары</td>
										<td>включает две пары одинаковых карт плюс одна любая карта</td>
										<td>ставка*1,5</td>
									</tr>
									<tr>
										<td>Сет</td>
										<td>три одинаковых карты из пяти</td>
										<td>ставка*2,5</td>
									</tr>
									<tr>
										<td>Стрит</td>
										<td>пять карт следующие друг за другом по рангу, но не совпадающие по масти</td>
										<td>ставка*5</td>
									</tr>
									<tr>
										<td>Флеш</td>
										<td>пять карт одной масти</td>
										<td>ставка*10</td>
									</tr>
									<tr>
										<td>Фул хауз</td>
										<td>три карты одного ранга плюс 2 карты другого</td>
										<td>ставка*15</td>
									</tr>
									<tr>
										<td>Каре</td>
										<td>четыре карты одного ранга</td>
										<td>ставка*50</td>
									</tr>
									<tr>
										<td>Стрит-флеш</td>
										<td>карты по старшинству одной масти</td>
										<td>ставка*100</td>
									</tr>
									<tr>
										<td>Роял-флеш</td>
										<td>является частным случаем стрит-флеш, где выпали карты по старшинству одной масти до старшей карты от 10 до A</td>
										<td>ставка*200</td>
									</tr>
								</tbody>
							</table>
						</div>
					
					<?php } else { ?>
					
						<p>
							Ваша ставка: <code><?php echo $a_pok['stavka']; ?> руб.</code><br/>
							Можно сменить <?php echo 2-$a_pok['zamena']; ?> карты
						</p>
						
						<?php
							if($comb == 1) { echo 'Комбинация: <code>Старшая карта</code><br/>'; }
							else if($comb == 2) { echo 'Комбинация: <code>Пара</code><br/>'; }
							else if($comb == 3) { echo 'Комбинация: <code>Две пары</code><br/>'; }
							else if($comb == 4) { echo 'Комбинация: <code>Сет</code><br/>'; }
							else if($comb == 5) { echo 'Комбинация: <code>Стрит</code><br/>'; }
							else if($comb == 6) { echo 'Комбинация: <code>Флеш</code><br/>'; }
							else if($comb == 7) { echo 'Комбинация: <code>Фул хауз</code><br/>'; }
							else if($comb == 8) { echo 'Комбинация: <code>Каре</code><br/>'; }
							else if($comb == 9) { echo 'Комбинация: <code>Стрит-флеш</code><br/>'; }
							else if($comb == 10) { echo 'Комбинация: <code>Роял-флеш</code><br/>'; }
						?>
						Вы выиграете: <code><?php echo $priz; ?> руб.</code>
						
						<div style="display:inline-block; width:100%; margin-top:20px; margin-bottom:20px;">
					
							<div style="position:relative; width:18%; margin-right:5px; float:left; display:block;">
								<?php if($a_pok['zamena'] < 2) { ?>
									<div style="position:absolute; bottom:6%; opacity:0.6; width:100%;">
										<center><input type="submit" class="special" name="smen1" value="Сменить карту" style="font-size:10px;"/></center>
										<?php
											if(isset($_POST['smen1'])) {
												$sqlpok2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='". $smen_cart ."', `zamena`=`zamena`+1, `lot`='1' WHERE `id`='".$a_pok['id']."'");
												echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>';
											}
										?>
									</div>
								<?php } ?>
								<img src="<?php echo $a_cart1['pic']; ?>" style="width:100%;">
							</div>
							
							<div style="position:relative; width:18%; margin-right:5px; float:left; display:block;">
								<?php if($a_pok['zamena'] < 2) { ?>
									<div style="position:absolute; bottom:6%; opacity:0.6; width:100%;">
										<center><input type="submit" class="special" name="smen2" value="Сменить карту" style="font-size:10px;"/></center>
										<?php
											if(isset($_POST['smen2'])) {
												$sqlpok2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='". $smen_cart ."', `zamena`=`zamena`+1, `lot`='2' WHERE `id`='".$a_pok['id']."'");
												echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>';
											}
										?>
									</div>
								<?php } ?>
								<img src="<?php echo $a_cart2['pic']; ?>" style="width:100%;">
							</div>
							
							<div style="position:relative; width:18%; margin-right:5px; float:left; display:block;">
								<?php if($a_pok['zamena'] < 2) { ?>
									<div style="position:absolute; bottom:6%; opacity:0.6; width:100%;">
										<center><input type="submit" class="special" name="smen3" value="Сменить карту" style="font-size:10px;"/></center>
										<?php
											if(isset($_POST['smen3'])) {
												$sqlpok2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart3`='". $smen_cart ."', `zamena`=`zamena`+1, `lot`='3' WHERE `id`='".$a_pok['id']."'");
												echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>';
											}
										?>
									</div>
								<?php } ?>
								<img src="<?php echo $a_cart3['pic']; ?>" style="width:100%;">
							</div>
							
							<div style="position:relative; width:18%; margin-right:5px; float:left; display:block;">
								<?php if($a_pok['zamena'] < 2) { ?>
									<div style="position:absolute; bottom:6%; opacity:0.6; width:100%;">
										<center><input type="submit" class="special" name="smen4" value="Сменить карту" style="font-size:10px;"/></center>
										<?php
											if(isset($_POST['smen4'])) {
												$sqlpok2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart4`='". $smen_cart ."', `zamena`=`zamena`+1, `lot`='4' WHERE `id`='".$a_pok['id']."'");
												echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>';
											}
										?>
									</div>
								<?php } ?>
								<img src="<?php echo $a_cart4['pic']; ?>" style="width:100%;">
							</div>
								
							<div style="position:relative; width:18%; margin-right:5px; float:left; display:block;">
								<?php if($a_pok['zamena'] < 2) { ?>
									<div style="position:absolute; bottom:6%; opacity:0.6; width:100%;">
										<center><input type="submit" class="special" name="smen5" value="Сменить карту" style="font-size:10px;"/></center>
										<?php
											if(isset($_POST['smen5'])) {
												$sqlpok2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart5`='". $smen_cart ."', `zamena`=`zamena`+1, `lot`='5' WHERE `id`='".$a_pok['id']."'");
												echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>';
											}
										?>
									</div>
								<?php } ?>
								<img src="<?php echo $a_cart5['pic']; ?>" style="width:100%;">
							</div>
						
						
						</div>
						
						<p>
							<input type="submit" class="btn btn-info" name="end" value="Завершить" /> <input type="submit" class="btn btn-danger" name="stav_n" value="Завершить и раздать заново (<?php echo $a_pok['stavka']; ?> руб.)" />
							
						
							<?php
								if(isset($_POST['stav_n'])) {
									
									if($a['money_pok'] >= $a_pok['stavka']) {
									
									for($i=1; $i<52; $i++) {
									$temp = rand(1,52);
									$flag = 1;
									$k = 0;
									while($flag == 1 && $k < $i) {
										if($mas[$k] == $temp) { $flag = 2; }
										$k++;
									}
									if($flag == 1) { $mas[$i] = $temp; }
								}
										
										// result: 1 - выиграл, 0 - проиграл, 3 - смена
										if($priz <= 0) { $pob = 0; $stvp = round($a_pok['stavka']-($a_pok['stavka']*0.3)); } else { $pob = 1; $stvp = round($priz-($priz*0.3)); }
										$sqlst = mysqli_query($mysqli, "INSERT INTO `poker_bank`(`id_users`, `zoloto`, `result`, `date`, `comb`, `sum`) VALUES ('".$a['id']."', '".$stvp."', '".$pob."', '". date("Y-m-d H:i:s") ."', '".$comb."', '".$priz."')");
										if($pob == 1) {
											$sqlst3 = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`=`money_pok`+'".$priz."' WHERE `id`='".$a['id']."'");
										}
										
										$sqlst4 = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`=`money_pok`-'".$a_pok['stavka']."' WHERE `id`='".$a['id']."'");
										$sqlst5 = mysqli_query($mysqli, "UPDATE `poker` SET `cart1`='".$smen_cart1."', `cart2`='".$smen_cart2."', `cart3`='".$smen_cart3."', `cart4`='".$smen_cart4."', `cart5`='".$smen_cart5."', `zamena`='0', `lot`='0' WHERE `id`='".$a_pok['id']."'");
										
										echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>'
										;
									} else {
										echo '<script type="text/javascript"> top.alert("Не хватает денег!"); top.window.location.href="poker.php"; </script>';
									}
								}
							?>
						</p>
						
						<?php
							if(isset($_POST['end'])) {
								// result: 1 - выиграл, 0 - проиграл, 3 - смена
								if($priz <= 0) { $pob = 0; $stvp = round($a_pok['stavka']-($a_pok['stavka']*0.3)); } else { $pob = 1; $stvp = round($priz-($priz*0.3)); }
								$sqlst = mysqli_query($mysqli, "INSERT INTO `poker_bank`(`id_users`, `zoloto`, `result`, `date`, `comb`, `sum`) VALUES ('".$a['id']."', '".$stvp."', '".$pob."', '". date("Y-m-d H:i:s") ."', '".$comb."', '".$priz."')");
								if($pob == 1) {
									$sqlst3 = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`=`money_pok`+'".$priz."' WHERE `id`='".$a['id']."'");
								}
								
								$sqlst4 = mysqli_query($mysqli, "DELETE FROM `poker` WHERE `id`='".$a_pok['id']."'");
								echo '<script type="text/javascript"> top.window.location.href="poker.php"; </script>';
							}
						?>
						
						<br/><div class="table table-bordered">
							<table style="font-size:12px;">
								<thead>
									<tr>
										<th>Комбинация</th>
										<th>Описание</th>
										<th>Выигрыш</th>
									</tr>
								</thead>
								<tbody>
									<tr <?php if($comb == 1) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 1) { echo ' style="color:#fff;" '; } ?>>Старшая карта</td>
										<td <?php if($comb == 1) { echo ' style="color:#fff;" '; } ?>>одна старшая карта или любая комбинация отличная от других</td>
										<td <?php if($comb == 1) { echo ' style="color:#fff;" '; } ?>>-</td>
									</tr>
									<tr <?php if($comb == 2) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 2) { echo ' style="color:#fff;" '; } ?>>Пара</td>
										<td <?php if($comb == 2) { echo ' style="color:#fff;" '; } ?>>две из пяти карт одинакового ранга</td>
										<td <?php if($comb == 2) { echo ' style="color:#fff;" '; } ?>>ставка*0,5</td>
									</tr>
									<tr <?php if($comb == 3) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 3) { echo ' style="color:#fff;" '; } ?>>Две пары</td>
										<td <?php if($comb == 3) { echo ' style="color:#fff;" '; } ?>>включает две пары одинаковых карт плюс одна любая карта</td>
										<td <?php if($comb == 3) { echo ' style="color:#fff;" '; } ?>>ставка*1,5</td>
									</tr>
									<tr <?php if($comb == 4) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 4) { echo ' style="color:#fff;" '; } ?>>Сет</td>
										<td <?php if($comb == 4) { echo ' style="color:#fff;" '; } ?>>три одинаковых карты из пяти</td>
										<td <?php if($comb == 4) { echo ' style="color:#fff;" '; } ?>>ставка*2,5</td>
									</tr>
									<tr <?php if($comb == 5) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 5) { echo ' style="color:#fff;" '; } ?>>Стрит</td>
										<td <?php if($comb == 5) { echo ' style="color:#fff;" '; } ?>>пять карт следующие друг за другом по рангу, но не совпадающие по масти</td>
										<td <?php if($comb == 5) { echo ' style="color:#fff;" '; } ?>>ставка*5</td>
									</tr>
									<tr <?php if($comb == 6) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 6) { echo ' style="color:#fff;" '; } ?>>Флеш</td>
										<td <?php if($comb == 6) { echo ' style="color:#fff;" '; } ?>>пять карт одной масти</td>
										<td <?php if($comb == 6) { echo ' style="color:#fff;" '; } ?>>ставка*10</td>
									</tr>
									<tr <?php if($comb == 7) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 7) { echo ' style="color:#fff;" '; } ?>>Фул хауз</td>
										<td <?php if($comb == 7) { echo ' style="color:#fff;" '; } ?>>три карты одного ранга плюс 2 карты другого</td>
										<td <?php if($comb == 7) { echo ' style="color:#fff;" '; } ?>>ставка*15</td>
									</tr>
									<tr <?php if($comb == 8) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 8) { echo ' style="color:#fff;" '; } ?>>Каре</td>
										<td <?php if($comb == 8) { echo ' style="color:#fff;" '; } ?>>четыре карты одного ранга</td>
										<td <?php if($comb == 8) { echo ' style="color:#fff;" '; } ?>>ставка*50</td>
									</tr> 
									<tr <?php if($comb == 9) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 9) { echo ' style="color:#fff;" '; } ?>>Стрит-флеш</td>
										<td <?php if($comb == 9) { echo ' style="color:#fff;" '; } ?>>карты по старшинству одной масти</td>
										<td <?php if($comb == 9) { echo ' style="color:#fff;" '; } ?>>ставка*100</td>
									</tr>
									<tr <?php if($comb == 10) { echo ' style="background:#FB9337;" '; } ?>>
										<td <?php if($comb == 10) { echo ' style="color:#fff;" '; } ?>>Роял-флеш</td>
										<td <?php if($comb == 10) { echo ' style="color:#fff;" '; } ?>>является частным случаем стрит-флеш, где выпали карты по старшинству одной масти до старшей карты от 10 до A</td>
										<td <?php if($comb == 10) { echo ' style="color:#fff;" '; } ?>>ставка*200</td>
									</tr>
								</tbody>
							</table>
						</div>
					
					<?php } ?>
								
								
								
								
								
								
							</form>							
						
					</div>
				</div>
			</div>
			
			<div class="row row-sm mg-t-15 mg-sm-t-20">
				<div class="col-md-12">
					<div class="card pd-20 pd-sm-40">
						<h6 class="card-body-title">Последние 10 выигрышных комбинация</h6>
						<p class="mg-b-20 mg-sm-b-30">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>Логин</th>
										<th>Сумма</th>
										<th>Комбинация</th>
										<th>Дата</th>
									</tr>
									<?php
										$sql_n = mysqli_query($mysqli, "SELECT `id_users`, `sum`, `comb`, `date` FROM `poker_bank` WHERE `sum`>0 ORDER by `date` DESC LIMIT 0,10");
										while($row_n = mysqli_fetch_assoc($sql_n)) {
											$user_l = mysqli_fetch_array(mysqli_query($mysqli, "select `login` from `users` where `id`='".$row_n['id_users']."'"));
									?>	
											<tr>
												<td><?php echo $user_l['login'];?></td>
												<td><?php echo $row_n['sum'];?> руб.</td>
												<td>
													<?php
														if($row_n['comb'] == 1) { echo 'Старшая карта'; }
														else if($row_n['comb'] == 2) { echo 'Пара'; }
														else if($row_n['comb'] == 3) { echo 'Две пары'; }
														else if($row_n['comb'] == 4) { echo 'Сет'; }
														else if($row_n['comb'] == 5) { echo 'Стрит'; }
														else if($row_n['comb'] == 6) { echo 'Флеш'; }
														else if($row_n['comb'] == 7) { echo 'Фул хауз'; }
														else if($row_n['comb'] == 8) { echo 'Каре'; }
														else if($row_n['comb'] == 9) { echo 'Стрит-флеш'; }
														else if($row_n['comb'] == 10) { echo 'Роял-флеш'; }
													?>
												</td>
												<td><?php echo date_format(date_create($row_n['date']), 'd.m.Y в H:i');?></td>
											</tr>
									<?php } ?>
								</tbody>
							</table>
						</p>
					</div>
				</div>
			</div>
        
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>