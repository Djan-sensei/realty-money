<?php
$secret = '**************'; 

$notification_type = $_POST['notification_type'];
$operation_id = $_POST['operation_id'];
$amount = $_POST['amount'];
$withdraw_amount = $_POST['withdraw_amount'];
$currency = $_POST['currency'];
$datetime = $_POST['datetime'];
$sender = $_POST['sender'];
$codepro = $_POST['codepro'];
$label = $_POST['label'];
$sha1_hash = $_POST['sha1_hash'];
 
$string = "$notification_type&$operation_id&$amount&$currency&$datetime&$sender&$codepro&$secret&$label";
 
$sha1 = hash("sha1", $string);

if($sha1 != $sha1_hash) {
	exit;
}

$labl = explode('_', $label);

/**************************** BODY ****************************/	
		
	// подключение к БД
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	// Текущая дата
	$date_now = date("Y-m-d H:i:s");
	
	
if($labl[0] == 'serf') {	
		
	// Таблица пользователя
	$serf = mysqli_fetch_array(mysqli_query($mysqli, "select * from `serf_add` where `id`='". $labl[1] ."'"));
	
	// Сумма пополнения
	$money_p = round($withdraw_amount,2); // Округляем
	
	$money_iz = round($serf['money']+$money_p, 2);
	
	$sql_serf1 = mysqli_query($mysqli, "UPDATE `serf_add` SET `money`='".$money_iz."' WHERE `id`='".$serf['id']."'");		
	
	$sql_serf2 = mysqli_query($mysqli, "INSERT INTO `serf_money`(`id_serf`, `money`, `date`) VALUES ('".$labl[1]."', '".$money_p."', '".$date_now."')");
	
	// Таблица пользователя
	$a_users = mysqli_fetch_array(mysqli_query($mysqli, "select * from `users` where `id`='". $serf['id_users'] ."'"));
	
	$x_ref1 = 5;
		
	// Отчисление реферу 1 уровня (Узнаем кто рефер)
	$a_ref = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `users` WHERE `id`='".$a_users['ref']."'"));
	
	if($a_ref['id']) {			
		// Сумма начисления реферу
		$money_ref_nach = ($money_p*$x_ref1)/100;
		$money_ref_nach = round($money_ref_nach, 2); // Округляем
		
		// Прибавляем сумму пополнения к общей сумме рефера
		$money_ref = $a_ref['money_viv']+$money_ref_nach;
		$money_ref = round($money_ref,2); // Округляем
			
		// Изменяем сумму у рефера
		$sql_ref_money = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`='".$money_ref."' WHERE `id`='".$a_ref['id']."'");
			
		// Делаем запись в статистику
		$sql_pop = mysqli_query($mysqli, "INSERT INTO `dvizh` (`id_users`, `money`, `otkogo`, `date`, `info`) VALUES ('".$a_ref['id']."', '".$money_ref_nach."', '". $serf['id_users'] ."', '".$date_now."', 'Начислено с реферала 1 уровня (серфинг)')");
		
	}
	
}


/*************** ПОПОЛНЕНИЕ БАЛАНСА ***************/
else {

	// Запись пополнения
	$sql_up = mysqli_query($mysqli, "INSERT INTO `users_money`(`id_users`, `money`, `date`) VALUES ('". $label ."', '". $amount ."', '".$date_now."')");
	
	// Таблица пользователя
	$a_users = mysqli_fetch_array(mysqli_query($mysqli, "select * from `users` where `id`='". $label ."'"));
	
	// Сумма пополнения
	$money_p = round($amount,2); // Округляем

	// Прибавляем сумму пополнения к общей сумме пользователя
	$money = $a_users['money_pok'] + $money_p;
	
	// Прибавляем бонус от суммы пополнения.
	if($money_p >= 500 and $money_p < 1000) {
		$money = $money + $money_p*0.03;
		$money = round($money, 2);
	} else if($money_p >= 1000 and $money_p < 5000) {
		$money = $money + $money_p*0.05;
		$money = round($money, 2);
	} else if($money_p >= 5000 and $money_p < 10000) {
		$money = $money + $money_p*0.07;
		$money = round($money, 2);
	} else if($money_p >= 10000) {
		$money = $money + $money_p*0.10;
		$money = round($money, 2);
	}  else {
		$money = round($money, 2);	
	}
	
	// Изменяем сумму у пользователя
	$sql = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`='".$money."' WHERE `id`='". $label ."'");
	
	$x_ref1 = 7;
	$x_ref2 = 3;
	
	// Отчисление реферу 1 уровня (Узнаем кто рефер)
	$a_ref = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `users` WHERE `id`='".$a_users['ref']."'"));
	
	if($a_ref['id']) {			
		// Сумма начисления реферу
		$money_ref_nach = ($money_p*$x_ref1)/100;
		$money_ref_nach = round($money_ref_nach, 2); // Округляем
		
		// Прибавляем сумму пополнения к общей сумме рефера
		$money_ref = $a_ref['money_viv']+$money_ref_nach;
		$money_ref = round($money_ref,2); // Округляем
			
		// Изменяем сумму у рефера
		$sql_ref_money = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`='".$money_ref."' WHERE `id`='".$a_ref['id']."'");
			
		// Делаем запись в статистику
		$sql_pop = mysqli_query($mysqli, "INSERT INTO `dvizh` (`id_users`, `money`, `otkogo`, `date`, `info`) VALUES ('".$a_ref['id']."', '".$money_ref_nach."', '". $label ."', '".$date_now."', 'Начислено с реферала 1 уровня')");
		
		
			// Отчисление реферу 2 уровня (Узнаем кто рефер)
			$a_ref2 = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM `users` WHERE `id`='".$a_ref['ref']."'"));
			
			if($a_ref2['id']) {			
				// Сумма начисления реферу
				$money_ref2_nach = ($money_p*$x_ref2)/100;
				$money_ref2_nach = round($money_ref2_nach, 2); // Округляем
				
				// Прибавляем сумму пополнения к общей сумме рефера
				$money_ref2 = $a_ref2['money_viv']+$money_ref2_nach;
				$money_ref2 = round($money_ref2,2); // Округляем
					
				// Изменяем сумму у рефера
				$sql_ref2_money = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`='".$money_ref2."' WHERE `id`='".$a_ref2['id']."'");
					
				// Делаем запись в статистику
				$sql_pop2 = mysqli_query($mysqli, "INSERT INTO `dvizh` (`id_users`, `money`, `otkogo`, `date`, `info`) VALUES ('".$a_ref2['id']."', '".$money_ref2_nach."', '". $label ."', '".$date_now."', 'Начислено с реферала 2 уровня')");
			}
		
	}
	
}

/**************************** [end]BODY ****************************/

?>