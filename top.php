<div class="am-header">	
	<div class="am-header-left">
		<a id="naviconLeft" href="" class="am-navicon d-none d-lg-flex"><i class="icon ion-navicon-round"></i></a>
		<a id="naviconLeftMobile" href="" class="am-navicon d-lg-none"><i class="icon ion-navicon-round"></i></a>
		<a href="/" class="am-logo">Realty<span style="color:#FB9337;">Money</span></a>
	</div>
	<div class="am-header-right">			
		<div class="dropdown dropdown-profile">
			<a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
				<img src="img/img11.jpg" class="wd-32 rounded-circle" alt="">
				<span class="logged-name">
					<span class="hidden-xs-down"><?php echo $_SESSION['user']; ?></span> <i class="fa fa-angle-down mg-l-3"></i>
				</span>
			</a>
			<div class="dropdown-menu wd-200">
				<ul class="list-unstyled user-profile-nav">
					<li><a href="profile.php"><i class="icon ion-ios-person-outline"></i> Профиль</a></li>
					<li><a href="settings.php"><i class="icon ion-ios-gear-outline"></i> Настройки</a></li>
					<li><a href="destroy.php"><i class="icon ion-power"></i> Выход</a></li>
				</ul>
			</div>
		</div>
	</div>		
</div>

<?php
	$r_news_end = mysqli_query($mysqli, "select `id`, `name`, `text` from `news` ORDER by `date` DESC LIMIT 0,1");
	$a_news_end = mysqli_fetch_array($r_news_end);
?>
<div id="cl_nc" style="position:fixed; bottom:10px; right:20px; z-index: 9999; max-width: 500px; width: 80%; min-height:100px; max-height: 300px; background:#f7f7f7; padding:10px; border: 3px solid #FB9337; display:none;">
	<h4 style="color:#20252B; margin-top:0px;"><?php echo $a_news_end['name']; ?></h4>
	<div style="overflow:hidden; overflow-y:auto; height:120px; margin-bottom:10px;"><?php echo $a_news_end['text']; ?></div>
	<center><a href="news.php" class="btn btn-sm btn-info">другие новости</a> <button type="button" onclick="cl_nc();" class="btn btn-sm btn-danger" style="cursor:pointer;">Закрыть</button></center>
	<script>
		function getCookie(name) {
			var r = document.cookie.match("(^|;) ?" + name + "=([^;]*)(;|$)");
			if (r) return r[2];
			else return "";
		  }		  
		  window.onload = function sfs() {
			var cl_nc = getCookie("cl_nc");
			if(cl_nc != '<?php echo $a_news_end['id']; ?>') {
				$('div[id="cl_nc"]').fadeIn(500);
			}
		}		
		function cl_nc() {
			document.cookie = "cl_nc=<?php echo $a_news_end['id']; ?>";
			$('div[id="cl_nc"]').fadeOut(500);
		}		 
	</script>
</div>