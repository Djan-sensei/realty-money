<?php
if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
{
	$m_key = 'mTaKse1Q3BvVQqiy';
	$arHash = array($_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$m_key);
	$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
	if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
	{		
		echo $_POST['m_orderid'].'|success';
		
/**************************** BODY ****************************/	
		
		// $m_orderid[0] - ID пользователя
		$m_orderid = explode('_', $_POST['m_orderid']);
		
		// подключение к БД
		$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
		mysqli_query($mysqli, "set names utf8");
		
		// Текущая дата
		$date_now = date("Y-m-d H:i:s");
		
if($m_orderid[0] == 'serf') {	
		
	// Таблица пользователя
	$serf = mysqli_fetch_array(mysqli_query($mysqli, "select * from `serf_add` where `id`='". $m_orderid[1] ."'"));
	
	// Сумма пополнения
	$money_p = round($_POST['m_amount'],2); // Округляем
	
	$money_iz = round($serf['money']+$money_p, 2);
	
	$sql_serf1 = mysqli_query($mysqli, "UPDATE `serf_add` SET `money`='".$money_iz."' WHERE `id`='".$serf['id']."'");		
	
	$sql_serf2 = mysqli_query($mysqli, "INSERT INTO `serf_money`(`id_serf`, `money`, `date`) VALUES ('".$m_orderid[1]."', '".$money_p."', '".$date_now."')");
	
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
		$sql_up = mysqli_query($mysqli, "INSERT INTO `users_money`(`id_users`, `money`, `date`) VALUES ('". $m_orderid[0] ."', '". $_POST['m_amount'] ."', '".$date_now."')");
		
		// Таблица пользователя
		$a_users = mysqli_fetch_array(mysqli_query($mysqli, "select * from `users` where `id`='". $m_orderid[0] ."'"));
		
		// Сумма пополнения
		$money_p = round($_POST['m_amount'],2); // Округляем

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
		$sql = mysqli_query($mysqli, "UPDATE `users` SET `money_pok`='".$money."' WHERE `id`='". $m_orderid[0] ."'");
		
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
			$sql_pop = mysqli_query($mysqli, "INSERT INTO `dvizh` (`id_users`, `money`, `otkogo`, `date`, `info`) VALUES ('".$a_ref['id']."', '".$money_ref_nach."', '". $m_orderid[0] ."', '".$date_now."', 'Начислено с реферала 1 уровня')");
			
			
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
					$sql_pop2 = mysqli_query($mysqli, "INSERT INTO `dvizh` (`id_users`, `money`, `otkogo`, `date`, `info`) VALUES ('".$a_ref2['id']."', '".$money_ref2_nach."', '". $m_orderid[0] ."', '".$date_now."', 'Начислено с реферала 2 уровня')");
				}
			
		}
		
}

/**************************** [end]BODY ****************************/	
		
		exit;
	}
	echo $_POST['m_orderid'].'|error';
}
?>