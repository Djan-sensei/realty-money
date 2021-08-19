<?php

$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
mysqli_query($mysqli, "set names utf8");

session_start();

$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `login` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));

$m_shop = '**************';
$m_key = '**************';
$m_curr = 'RUB';

if($_GET['par'] == 'serf') {
	$m_orderid = strval('serf_'.(int)$_GET['id_serf']);
	$m_amount = number_format($_GET['m_amount'], 2, '.', '');
	$m_desc = base64_encode('Пополнение серфинга ID '.(int)$_GET['id_serf'].', пользователь '.$user['login']);
} else {
	$m_orderid = strval($user['id']).'_'.rand(1000000,9999999);
	$m_amount = number_format($_GET['p_money'], 2, '.', '');
	$m_desc = base64_encode('Пополнение баланса, пользователь '.$user['login'].' (ID '.$user['id'].')');
}

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc,
	$m_key
);
$sign = strtoupper(hash('sha256', implode(':', $arHash)));
?>

<form method="GET" action="https://payeer.com/merchant/">
<input type="hidden" name="m_shop" value="<?php echo $m_shop; ?>">
<input type="hidden" name="m_orderid" value="<?php echo $m_orderid; ?>">

<input type="text" id="m_amount" name="m_amount" value="<?php echo $m_amount; ?>" style="margin-left:6px; padding: 0px 10px 0px 10px; border: 1px solid rgba(10, 168, 182, 0.25);margin-bottom: 10px; width:80px; text-align:center;" readonly > руб.

<input type="hidden" name="m_curr" value="<?php echo $m_curr; ?>">
<input type="hidden" name="m_desc" value="<?php echo $m_desc; ?>">
<input type="hidden" name="m_sign" value="<?php echo $sign; ?>">

<br/><button type="submit" name="m_process">Подтвердить</button>
</form>