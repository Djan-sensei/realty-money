<?php 

$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
mysqli_query($mysqli, "set names utf8");

session_start();

$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `ban`, `pod`, `pass_vivod`, `money_viv`, `payeer`, `yandex`, `qiwi`, `visa`, `mastercard`, `maestro`, `beeline`, `megafon`, `mts`, `tele2` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));

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

// Для автовыплат
require_once('cpayeer.php');
$accountNumber = '**************';
$apiId = '**************';
$apiKey = '**************';


/*************** АВТОВЫПЛАТА НА PAYEER  ***************/

	$rv_payeer = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='P' and `prov`='1'");
	$av_payeer = mysqli_fetch_array($rv_payeer);
	$money_perevod = round($av_payeer['money'], 2);
	if($av_payeer['id'] and $money_perevod >= 1 and $money_perevod <= 5000 and !empty($user['payeer'])) {
		$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($payeer->isAuth()) {
			
			$arBalance = $payeer->getBalance();
			$balance = round(($arBalance['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			$arPs = $payeer->getPaySystems();
			
			if($money_perevod < $balance and $money_perevod > 0) {
				$arTransfer = $payeer->transfer(array(
					'curIn' => 'RUB',
					'sum' => $money_perevod,
					'curOut' => 'RUB',
					'to' => $user['payeer'],
					'comment' => 'Вывод денег из игры realty-money.ru (Пользователь ID '.$user['id'].')',
					'anonim' => 'Y',
				));
				if (empty($arTransfer['errors'])) {
					//echo $arTransfer['historyId'].": Перевод средств успешно выполнен";
					$sql_ok = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_payeer['id']."'");
					echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
					exit;
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($arTransfer["errors"], true).'</pre>';
				}
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($payeer->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА PAYEER ***************/



/*************** АВТОВЫПЛАТА НА YANDEX  ***************/

	$rv_yandex = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='Y' and `prov`='1'");
	$av_yandex = mysqli_fetch_array($rv_yandex);
	$money_perevod_yandex = round($av_yandex['money'], 2);
	if($av_yandex['id'] and $money_perevod_yandex >= 15 and $money_perevod_yandex <= 5000 and !empty($user['yandex'])) {
		$yandex = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($yandex->isAuth()) {
			
			$arBalance_yandex = $yandex->getBalance();
			$balance_yandex = round(($arBalance_yandex['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_yandex < $balance_yandex and $money_perevod_yandex > 0) {
				$initOutput_yandex = $yandex->initOutput(array(
					'ps' => '25344',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_yandex,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['yandex'],
				));
				
				if($initOutput_yandex) {
					$historyId_yandex = $yandex->output();
					if ($historyId_yandex > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_yandex['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($yandex->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($yandex->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($yandex->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА YANDEX ***************/



/*************** АВТОВЫПЛАТА НА QIWI  ***************/

	$rv_qiwi = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='Q' and `prov`='1'");
	$av_qiwi = mysqli_fetch_array($rv_qiwi);
	$money_perevod_qiwi = round($av_qiwi['money'], 2);
	if($av_qiwi['id'] and $money_perevod_qiwi >= 15 and $money_perevod_qiwi <= 5000 and !empty($user['qiwi'])) {
		$qiwi = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($qiwi->isAuth()) {
			
			$arBalance_qiwi = $qiwi->getBalance();
			$balance_qiwi = round(($arBalance_qiwi['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_qiwi < $balance_qiwi and $money_perevod_qiwi > 0) {
				$initOutput_qiwi = $qiwi->initOutput(array(
					'ps' => '60792237',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_qiwi,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['qiwi'],
				));
				
				if($initOutput_qiwi) {
					$historyId_qiwi = $qiwi->output();
					if ($historyId_qiwi > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_qiwi['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($qiwi->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($qiwi->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($qiwi->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА QIWI ***************/



/*************** АВТОВЫПЛАТА НА VISA  ***************/

	$rv_visa = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='V' and `prov`='1'");
	$av_visa = mysqli_fetch_array($rv_visa);
	$money_perevod_visa = round($av_visa['money'], 2);
	if($av_visa['id'] and $money_perevod_visa >= 250 and $money_perevod_visa <= 5000 and !empty($user['visa'])) {
		$visa = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($visa->isAuth()) {
			
			$arBalance_visa = $visa->getBalance();
			$balance_visa = round(($arBalance_visa['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_visa < $balance_visa and $money_perevod_visa > 0) {
				$initOutput_visa = $visa->initOutput(array(
					'ps' => '117146509',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_visa,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['visa'],
				));
				
				if($initOutput_visa) {
					$historyId_visa = $visa->output();
					if ($historyId_visa > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_visa['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($visa->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($visa->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($visa->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА VISA ***************/



/*************** АВТОВЫПЛАТА НА MASTERCARD  ***************/

	$rv_mastercard = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='M' and `prov`='1'");
	$av_mastercard = mysqli_fetch_array($rv_mastercard);
	$money_perevod_mastercard = round($av_mastercard['money'], 2);
	if($av_mastercard['id'] and $money_perevod_mastercard >= 250 and $money_perevod_mastercard <= 5000 and !empty($user['mastercard'])) {
		$mastercard = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($mastercard->isAuth()) {
			
			$arBalance_mastercard = $mastercard->getBalance();
			$balance_mastercard = round(($arBalance_mastercard['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_mastercard < $balance_mastercard and $money_perevod_mastercard > 0) {
				$initOutput_mastercard = $mastercard->initOutput(array(
					'ps' => '117650874',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_mastercard,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['mastercard'],
				));
				
				if($initOutput_mastercard) {
					$historyId_mastercard = $mastercard->output();
					if ($historyId_mastercard > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_mastercard['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($mastercard->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($mastercard->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($mastercard->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА MASTERCARD ***************/



/*************** АВТОВЫПЛАТА НА MAESTRO/CIRRUS  ***************/

	$rv_maestro = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='MC' and `prov`='1'");
	$av_maestro = mysqli_fetch_array($rv_maestro);
	$money_perevod_maestro = round($av_maestro['money'], 2);
	if($av_maestro['id'] and $money_perevod_maestro >= 250 and $money_perevod_maestro <= 5000 and !empty($user['maestro'])) {
		$maestro = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($maestro->isAuth()) {
			
			$arBalance_maestro = $maestro->getBalance();
			$balance_maestro = round(($arBalance_maestro['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_maestro < $balance_maestro and $money_perevod_maestro > 0) {
				$initOutput_maestro = $maestro->initOutput(array(
					'ps' => '117653267',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_maestro,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['maestro'],
				));
				
				if($initOutput_maestro) {
					$historyId_maestro = $maestro->output();
					if ($historyId_maestro > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_maestro['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($maestro->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($maestro->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($maestro->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА MAESTRO/CIRRUS ***************/



/*************** АВТОВЫПЛАТА НА BEELINE  ***************/

	$rv_beeline = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='B' and `prov`='1'");
	$av_beeline = mysqli_fetch_array($rv_beeline);
	$money_perevod_beeline = round($av_beeline['money'], 2);
	if($av_beeline['id'] and $money_perevod_beeline >= 15 and $money_perevod_beeline <= 5000 and !empty($user['beeline'])) {
		$beeline = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($beeline->isAuth()) {
			
			$arBalance_beeline = $beeline->getBalance();
			$balance_beeline = round(($arBalance_beeline['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_beeline < $balance_beeline and $money_perevod_beeline > 0) {
				$initOutput_beeline = $beeline->initOutput(array(
					'ps' => '24898938',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_beeline,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['beeline'],
				));
				
				if($initOutput_beeline) {
					$historyId_beeline = $beeline->output();
					if ($historyId_beeline > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_beeline['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($beeline->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($beeline->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($beeline->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА BEELINE ***************/



/*************** АВТОВЫПЛАТА НА MEGAFON  ***************/

	$rv_megafon = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='MEG' and `prov`='1'");
	$av_megafon = mysqli_fetch_array($rv_megafon);
	$money_perevod_megafon = round($av_megafon['money'], 2);
	if($av_megafon['id'] and $money_perevod_megafon >= 15 and $money_perevod_megafon <= 5000 and !empty($user['megafon'])) {
		$megafon = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($megafon->isAuth()) {
			
			$arBalance_megafon = $megafon->getBalance();
			$balance_megafon = round(($arBalance_megafon['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_megafon < $balance_megafon and $money_perevod_megafon > 0) {
				$initOutput_megafon = $megafon->initOutput(array(
					'ps' => '24899391',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_megafon,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['megafon'],
				));
				
				if($initOutput_megafon) {
					$historyId_megafon = $megafon->output();
					if ($historyId_megafon > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_megafon['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($megafon->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($megafon->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($megafon->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА MEGAFON ***************/



/*************** АВТОВЫПЛАТА НА MTS  ***************/

	$rv_mts = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='MTS' and `prov`='1'");
	$av_mts = mysqli_fetch_array($rv_mts);
	$money_perevod_mts = round($av_mts['money'], 2);
	if($av_mts['id'] and $money_perevod_mts >= 15 and $money_perevod_mts <= 5000 and !empty($user['mts'])) {
		$mts = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($mts->isAuth()) {
			
			$arBalance_mts = $mts->getBalance();
			$balance_mts = round(($arBalance_mts['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_mts < $balance_mts and $money_perevod_mts > 0) {
				$initOutput_mts = $mts->initOutput(array(
					'ps' => '24899291',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_mts,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['mts'],
				));
				
				if($initOutput_mts) {
					$historyId_mts = $mts->output();
					if ($historyId_mts > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_mts['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($mts->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($mts->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($mts->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА MTS ***************/



/*************** АВТОВЫПЛАТА НА TELE2  ***************/

	$rv_tele2 = mysqli_query($mysqli, "select * from `users_vivod` where `id_users` = '".$user['id']."' and `vup` = '0' and `type`='T' and `prov`='1'");
	$av_tele2 = mysqli_fetch_array($rv_tele2);
	$money_perevod_tele2 = round($av_tele2['money'], 2);
	if($av_tele2['id'] and $money_perevod_tele2 >= 15 and $money_perevod_tele2 <= 5000 and !empty($user['tele2'])) {
		$tele2 = new CPayeer($accountNumber, $apiId, $apiKey);
		if ($tele2->isAuth()) {
			
			$arBalance_tele2 = $tele2->getBalance();
			$balance_tele2 = round(($arBalance_tele2['balance']['RUB']['DOSTUPNO_SYST'])/3,2);
			
			if($money_perevod_tele2 < $balance_tele2 and $money_perevod_tele2 > 0) {
				$initOutput_tele2 = $tele2->initOutput(array(
					'ps' => '95877310',
					'curIn' => 'RUB',
					'sumIn' => $money_perevod_tele2,
					'curOut' => 'RUB',
					'param_ACCOUNT_NUMBER' => $user['tele2'],
				));
				
				if($initOutput_tele2) {
					$historyId_tele2 = $tele2->output();
					if ($historyId_tele2 > 0) {
						$sql_oky = mysqli_query($mysqli, "UPDATE `users_vivod` SET `vup`='1' WHERE `id`='".$av_tele2['id']."'");
						echo '<script type="text/javascript"> top.window.location.href="vivod.php"; </script>';
						exit;
					} else {
						$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($tele2->getErrors(), true).'</pre>';
					}
				} else {
					$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($tele2->getErrors(), true).'</pre>';
				}
				
			} else {
				$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> Error #121nmon';
			}
			
		} else {
			$error = '<span style="color:red;">Сообщите ошибку на почту support@realty-money.ru:</span><br/> <pre>'.print_r($tele2->getErrors(), true).'</pre>';
		}
	}
			
/*************** [end]АВТОВЫПЛАТА НА TELE2 ***************/

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Вывод денег</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>

    

    <div class="am-mainpanel">
		<div class="am-pagetitle">
			<h5 class="am-title">Вывод денег</h5>
		</div>

		<div class="am-pagebody">
		
			<div class="row row-sm">
			
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
					
						<?php if(!empty($error)) { ?>
							<p class="mg-b-15"><?php echo $error; ?></p>
						<?php } ?>
						
						<p class="mg-b-15">Минимальная сумма выплаты 1 руб (Payeer), 250 руб (VISA, MASTERCARD, MAESTRO/CIRRUS), на остальные 15 руб. Номер кошелька задается в разделе <a href="settings.php">Настройки</a>. Деньги начисляются с учетом удержания комиссии в ЭПС. Максимальная сумма на вывод: 5000 руб.</p>
					
						<p class="mg-b-15">
							Возможен вывод на:
							<ul>
								<li>Payeer - комиссия 0,95%</li>
								<li>Yandex - комиссия 4,4%</li>
								<li>Qiwi - комиссия 5,4%</li>
								<li>VISA, MASTERCARD, MAESTRO/CIRRUS - комиссия 3,9% + 45 pуб.</li>
								<li>Билайн, Мегафон, МТС, Теле2 - комиссия 2%</li>
							</ul>
						</p>
						
					</div>
				</div>
				
				<div class="col-lg-12 mg-b-20">
					<div class="card">
						<div class="wd-100p ht-300"></div>
						<div class="overlay-body pd-x-20 pd-t-20">
							<p class="tx-12 mg-b-0">
								
								<?php 
									// Пополнено
									$user_pop = mysqli_fetch_array(mysqli_query($mysqli, "select SUM(`money`) as `sum` from `users_money` where `id_users`='".$user['id']."'"));
								?>
								<?php if($user_pop['sum'] >= 100) { ?>
								
								<iframe name="Frame" style="display:none;"></iframe>
								
								<form class="form" accept-charset="utf-8" action="" method="post" target="Frame">
									<input type="text" class="form-control" name="price" id="price" value="" placeholder="Сумма, руб." autocomplete="off"><br>
									<select name="type" class="form-control">
										<option value="Y">Яндекс</option>
										<option value="P">Payeer</option>
										<option value="Q">Qiwi</option>
										<option value="V">VISA</option>
										<option value="M">MASTERCARD</option>
										<option value="MC">MAESTRO/CIRRUS</option>
										<option value="B">Билайн</option>
										<option value="MEG">Мегафон</option>
										<option value="MTS">МТС</option>
										<option value="T">Теле2</option>
									</select><br>
									<?php if($user['pod'] == 1) { ?>
										<?php if(!empty($user['pass_vivod'])) { ?>
											<input type="password" class="form-control" name="pass" id="pass" value="" placeholder="Платежный пароль"><br>
											<input type="submit" class="btn btn-info" name="viv" value="Отправить заявку">
										<?php } else { ?>
											<p>Установите платежный пароль, перейти в <a href="settings.php">настройки</a>.</p>
										<?php } ?>
									<?php } else { ?>
										<p>Подтвердите e-mail адрес, перейти в <a href="settings.php">настройки</a>.</p>
									<?php } ?>
								</form>	

								<?php
									if (isset($_POST['viv'])) {
										$type = mysqli_real_escape_string($mysqli, $_POST['type']);
										$price = mysqli_real_escape_string($mysqli, $_POST['price']);
										$price = strip_tags($price);
										$price = htmlspecialchars($price);
										$price = (int)$price;
										$pass = mysqli_real_escape_string($mysqli, $_POST['pass']);
										
										if($user['pod'] == 0) {
											echo '<script type="text/javascript">top.alert("Почта не подтверждена!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($price > 5000) {
											echo '<script type="text/javascript">top.alert("Максимальная сумма ны вывод 5000 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($pass != $user['pass_vivod']) {
											echo '<script type="text/javascript">top.alert("Платежный пароль введен не верно!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if(empty($user['pass_vivod'])) {
											echo '<script type="text/javascript">top.alert("Платежный пароль не установлен!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'P' and empty($user['payeer'])) {
											echo '<script type="text/javascript">top.alert("Нет указан кошелек Payeer!"); top.window.location.href="vivod.php"; </script>';
											exit;
										}  else if($type == 'V' and empty($user['visa'])) {
											echo '<script type="text/javascript">top.alert("Нет указан номер карты VISA!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'Y' and empty($user['yandex'])) {
											echo '<script type="text/javascript">top.alert("Нет указан кошелек Yandex!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'Q' and empty($user['qiwi'])) {
											echo '<script type="text/javascript">top.alert("Нет указан кошелек Qiwi!"); top.window.location.href="vivod.php"; </script>';
											exit;
										}  else if($type == 'B' and empty($user['beeline'])) {
											echo '<script type="text/javascript">top.alert("Нет указан номер телефона Билайн!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'MEG' and empty($user['beeline'])) {
											echo '<script type="text/javascript">top.alert("Нет указан номер телефона Мегафон!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'MTS' and empty($user['beeline'])) {
											echo '<script type="text/javascript">top.alert("Нет указан номер телефона МТС!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'T' and empty($user['beeline'])) {
											echo '<script type="text/javascript">top.alert("Нет указан номер телефона Теле2!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'M' and empty($user['mastercard'])) {
											echo '<script type="text/javascript">top.alert("Нет указан номер карты MASTERCARD!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'MC' and empty($user['maestro'])) {
											echo '<script type="text/javascript">top.alert("Нет указан кошелек MAESTRO/CIRRUS!"); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'P' and $price < 1) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 1 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'Y' and $price < 15) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 15 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'Q' and $price < 15) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 15 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										}  else if($type == 'V' and $price < 250) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 250 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										}  else if($type == 'M' and $price < 250) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 250 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										}  else if($type == 'MC' and $price < 250) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 250 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										}   else if($type == 'B' and $price < 15) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 15 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'MEG' and $price < 15) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 15 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'MTS' and $price < 15) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 15 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										} else if($type == 'T' and $price < 15) {
											echo '<script type="text/javascript">top.alert("Минимальная сумма ны вывод 15 руб."); top.window.location.href="vivod.php"; </script>';
											exit;
										} else {
											if($user['money_viv'] >= $price and $price >= 1) {
												$mon_viv = round(($user['money_viv']-$price), 2);
												$sql1 = mysqli_query($mysqli, "UPDATE `users` SET `money_viv`='". $mon_viv ."' WHERE `id`='".$user['id']."'");
												
												if($price >= 1000) { $provg = 0; } else { $provg = 1; }
												
												$sql2 = mysqli_query($mysqli, "INSERT INTO `users_vivod`(`id_users`, `money`, `date`, `vup`, `type`, `prov`) VALUES ('".$user['id']."', '".$price."', '". date('Y-m-d H:i:s') ."', '0', '".$type."', '".$provg."')");
												echo '<script type="text/javascript">top.alert("Заявка подана!"); top.window.location.href="vivod.php"; </script>';
											} else {
												echo '<script type="text/javascript">top.alert("Нет такой суммы на вывод или она меньше 1!"); top.window.location.href="vivod.php"; </script>';
												exit;
											}
										}
									}
								?>
								
								<?php } else { ?>
								
								<p>Выплату могут заказывать пользователи, которые пополнили баланс больше, чем на 100 руб.</p>
								
								<?php } ?>
								
							</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						<h6 class="card-body-title">Последние 20 Ваших запросов на вывод</h6>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Сумма</th>
									<th>Кошелек</th>
									<th>Дата</th>
									<th>Статус</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql_vi = mysqli_query($mysqli, "SELECT * FROM `users_vivod` WHERE `id_users`='".$user['id']."' ORDER by `date` DESC LIMIT 0, 20");
									while($row_vi = mysqli_fetch_assoc($sql_vi)) {
								?>
									<tr>
										<td><?php echo $row_vi['money']; ?> руб.</td>
										<td><?php
											if($row_vi['type'] == 'Y') { echo 'Яндекс'; }
											else if($row_vi['type'] == 'P') { echo 'Payeer'; }
											else if($row_vi['type'] == 'Q') { echo 'Qiwi'; }
											else if($row_vi['type'] == 'V') { echo 'VISA'; }
											else if($row_vi['type'] == 'M') { echo 'MASTERCARD'; }
											else if($row_vi['type'] == 'MC') { echo 'MAESTRO/CIRRUS'; }
											else if($row_vi['type'] == 'B') { echo 'Билайн'; }
											else if($row_vi['type'] == 'MEG') { echo 'Мегафон'; }
											else if($row_vi['type'] == 'MTS') { echo 'МТС'; }
											else if($row_vi['type'] == 'T') { echo 'Теле2'; }
										?></td>
										<td><?php echo date_format(date_create($row_vi['date']), 'd.m.Y в H:i'); ?></td>
										<td><?php if($row_vi['vup'] == '0') { echo '<span style="color:orange;">В обработке</span>'; } else if($row_vi['vup'] == '1') { echo '<span style="color:green;">Выплачено</span>'; } ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						
					</div>
				</div>
				
				<div class="col-lg-12 mg-b-20">
					<div class="card pd-20">
						<h6 class="card-body-title">Мы на форумах</h6>						
						<p class="mg-b-15"><a href="https://mmgp.ru/showthread.php?t=570328" title="MMGP - Форум о заработке в Интернете и интернет-инвестировании" target="_blank"> <img src="img/monit/mmgp.gif" alt="MMGP - Форум о заработке в Интернете и интернет-инвестировании"></a> <a href="https://clck.ru/CtegU" title="MoneyMaker.team Делаем Деньги Вместе" target="_blank"> <img src="img/monit/moneymaker.jpg" alt="MoneyMaker.team Делаем Деньги Вместе"></a> <a href="https://clck.ru/Ctes3" title="ProfitHunters.ru - Форум о заработке и инвестициях в интернете" target="_blank"> <img src="img/monit/profithunters.jpg" alt="ProfitHunters.ru - Форум о заработке и инвестициях в интернете"></a> <a href="https://finforum.net/threads/realty-money-ru-realty-money.14230/" title="FinForum - Финансовый форум" target="_blank"> <img src="img/monit/finforum.jpg" alt="FinForum - Финансовый форум"></a> <a href="https://clck.ru/CttbK" title="Antimmgp.ru - заработок в Интернете, инвестиции и отзывы в Интернет" target="_blank"> <img src="img/monit/antimmgp.jpg" alt="Antimmgp.ru - заработок в Интернете, инвестиции и отзывы в Интернет"></a></p>
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="card pd-20">
						<h6 class="card-body-title">Мы на мониторингах</h6>						
						<p class="mg-b-15"><a href="https://clck.ru/CvFJk" title="well-money.ru - Игры с выводом денег" target="_blank"><img src="img/monit/well2.gif" alt="well-money.ru - Игры с выводом денег"></a> <a href="https://clck.ru/Cx23X" target="_blank"><img src="img/monit/160805-gamedom-88x31.gif" alt="GAMEDOM - ИГРЫ КОТОРЫЕ ПЛАТЯТ" width="88" height="31" border="0" /></a> <a href="https://mywmz.net/zarabotok-na-igrax" target="_blank"><img src="https://mywmz.net/wp-content/uploads/2017/05/M-88.gif"  width="88" height="31"/></a> <a href="https://moniktop.ru/ferma-info/412" title="MonikTop.ru - Мониторинг проектов с выводом денег" target="_blank"><img src="https://moniktop.ru/img/knopki_ferm/412.gif" alt="MonikTop.ru - Мониторинг проектов с выводом денег"></a> <a href="http://netweb-monitor.ru/ferm_new/728" title="netWEB-monitor.ru - Мониторинг игр с выводом денег" target="_blank"><img src="img/monit/pay1.gif" alt="netWEB-monitor.ru - Мониторинг игр с выводом денег"></a> <a href="https://monitorgame.com/game-page/RealtyMoney" target="_blank"><img src="https://monitorgame.com/m/images/9b7a2414d0e8a386dd468f9de868db04.jpg"></a> <a href="https://clck.ru/Cw9ut" target="_blank"><img src="img/monit/547.gif" width="88" height="31" border="0"></a> <a href="https://clck.ru/CteeC" target="_blank"><img src="img/monit/knopka.gif" width="88" height="31" border="0"></a> <a href="https://clck.ru/CteeJ" title="OroHyipRus - Проверено игра Платит!" target="_blank"> <img src="img/monit/88x31.gif" alt="OroHyipRus - Проверено игра Платит!"></a> <a href="https://clck.ru/Cteet" title="MonitorGam - Проверено игра Платит!" target="_blank"> <img src="img/monit/platit.gif" alt="MonitorGam - Проверено игра Платит!"></a> <a href="https://clck.ru/CtgpW" title="Мониторинг игр с выводом денег" target="_blank"> <img src="img/monit/knopka1.gif" alt="Мониторинг игр с выводом денег"></a> <a href="https://clck.ru/CuRut" title="Hyipgamesearn.ru  - мониторинг игр с выводом денег!" target="_blank"> <img src='img/monit/MF-88.gif' alt="Hyipgamesearn.ru - мониторинг игр с выводом денег!"></a> <a href="https://clck.ru/CuxFg" title="Игры с выводом денег" target="_blank"> <img src='img/monit/igra-platit.gif' alt="Игры с выводом денег"></a></p>
					</div>
				</div>
				
			</div>
        
		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>