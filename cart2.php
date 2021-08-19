<?php
// РОЯЛ ФЛЕШ - Если 5 карт одной масти и ранг идет по старшинству от 10 до А
if(
	($mafd1[0] == 9 and $mafd1[1] == 10 and $mafd1[2] == 11 and $mafd1[3] == 12 and $mafd1[4] == 13) and 
	($mast1 == 5 or $mast2 == 5 or $mast3 == 5 or $mast4 == 5) and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = $a_pok['stavka']*2000;
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// СТРИТ ФЛЕШ - Если 5 карт одной масти и ранг идет по старшинству (ранг +1)
else if(
	($mafd1[1] == ($tuz1+1) and $mafd1[2] == ($mafd1[1]+1) and $mafd1[3] == ($mafd1[2]+1) and $mafd1[4] == ($mafd1[3]+1)) and 
	($mast1 == 5 or $mast2 == 5 or $mast3 == 5 or $mast4 == 5) and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = $a_pok['stavka']*300;
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// КАРЕ или ПОКЕР ФЛЕШ - Если 4 карты одного ранга, любой масти
else if(
	$rang1 == 4 or $rang2 == 4 or $rang3 == 4 or $rang4 == 4 or $rang5 == 4 or $rang6 == 4 or $rang7 == 4 or $rang8 == 4 or $rang9 == 4 or $rang10 == 4 or $rang11 == 4 or $rang12 == 4 or $rang13 == 4 and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = $a_pok['stavka']*90;
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// ФУЛ-ХАУС - Если 3 карты одного ранга и 2 карты другого ранга любой масти
else if(
	($rang1 == 3 or $rang2 == 3 or $rang3 == 3 or $rang4 == 3 or $rang5 == 3 or $rang6 == 3 or $rang7 == 3 or $rang8 == 3 or $rang9 == 3 or $rang10 == 3 or $rang11 == 3 or $rang12 == 3 or $rang13 == 3) and 
	($rang1 == 2 or $rang2 == 2 or $rang3 == 2 or $rang4 == 2 or $rang5 == 2 or $rang6 == 2 or $rang7 == 2 or $rang8 == 2 or $rang9 == 2 or $rang10 == 2 or $rang11 == 2 or $rang12 == 2 or $rang13 == 2) and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = $a_pok['stavka']*15;
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// ФЛЕШ - Если все 5 карт одной масти
else if(
	$mast1 == 5 or $mast2 == 5 or $mast3 == 5 or $mast4 == 5 and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = $a_pok['stavka']*10;
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// СТРИТ - Если 5 карт разного ранга следуют друг за другом (ранг +1), не зависимо от масти, причем туз является как 1 так и старшей картой
else if(
	$mafd1[1] == ($tuz1+1) and $mafd1[2] == ($mafd1[1]+1) and $mafd1[3] == ($mafd1[2]+1) and $mafd1[4] == ($mafd1[3]+1) and 
	($mast1 != 5 or $mast2 != 5 or $mast3 != 5 or $mast4 != 5) and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = $a_pok['stavka']*5;
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// СЕТ - Если 3 карты имеют одинаковый ранг и любую масть
else if(
	$rang1 == 3 or $rang2 == 3 or $rang3 == 3 or $rang4 == 3 or $rang5 == 3 or $rang6 == 3 or $rang7 == 3 or $rang8 == 3 or $rang9 == 3 or $rang10 == 3 or $rang11 == 3 or $rang12 == 3 or $rang13 == 3 and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = round($a_pok['stavka']*2.5);
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// ДВЕ ПАРЫ - Если 2 карты одного ранга и 2 карты другого ранга из 5 имеют одинаковый ранг и любую масть
else if(
	$sumr == 2 and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = round($a_pok['stavka']*1.5);
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// ПАРА - Если 2 карты из 5 имеют одинаковый ранг и любую масть
else if(
	$rang1 == 2 or $rang2 == 2 or $rang3 == 2 or $rang4 == 2 or $rang5 == 2 or $rang6 == 2 or $rang7 == 2 or $rang8 == 2 or $rang9 == 2 or $rang10 == 2 or $rang11 == 2 or $rang12 == 2 or $rang13 == 2 and 
	$a_pok['lot'] == 2
) {	
	$priz_c2 = round($a_pok['stavka']*0.5);
	if($bank_pol < $priz_c2) {
		$ccart2 = mysqli_query($mysqli, "UPDATE `poker` SET `cart2`='".$smen_cart."' WHERE `id`='".$a_pok['id']."'");
		echo '<script type="text/javascript"> window.location.href="poker.php"; </script>';
		exit;
	}
}

// НИЧЕГО
else {	
	$priz_c2 = 0;
}
?>