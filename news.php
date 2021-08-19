<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RealtyMoney - Новости</title>
	<?php include('css.php'); ?>
</head>
<body>

	<?php include('top.php'); ?>
	
	<?php include('left.php'); ?>    

    <div class="am-mainpanel">
	
		<div class="am-pagetitle">
			<h5 class="am-title">Новости</h5>
		</div>
		
		<iframe name="Frame" style="display:none;"></iframe>

		<div class="am-pagebody">
			
			<?php
				$sql_news = mysqli_query($mysqli, "SELECT * FROM `news` ORDER by `date` DESC");
				while($row_news = mysqli_fetch_assoc($sql_news)) {
			?>
				<div class="card pd-20 pd-sm-40 mg-t-15 mg-sm-t-20">
					<h6 class="card-body-title"><?php echo $row_news['name']; ?></h6>
					<p class="tx-12"><?php echo date_format(date_create($row_news['date']), 'd.m.Y в H:i'); ?></p>
					<p class="mg-b-20 mg-sm-b-30"><?php echo $row_news['text']; ?></p>
				</div>
			<?php } ?>

		</div>
		
		<?php include('footer.php'); ?>
		
	</div>

	<?php include('scripts.php'); ?>
</body>
</html>