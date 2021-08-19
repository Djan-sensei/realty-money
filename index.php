<?php
	$mysqli = mysqli_connect("localhost", "**************", "**************", "**************");
	mysqli_query($mysqli, "set names utf8");
	
	session_start();
	
	$_SESSION['ref'] = $_GET['ref'];
	
	$user = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Metas -->
      <meta charset="utf-8">
      <title>RealtyMoney - экономическая игра с выводом денег</title>
     <meta name="description" content="Удивительно необыкновенный проект на вывод средств! Покупайте недвижимость различного уровня и зарабатывайте RUB. Автоматические выплаты денег! Без ограничений и баллов!">
	<meta name="keywords" content="на вывод, без вложений, вывод денег без вложений, без ограничений на вывод, без баллов, игры с выводом реальных денег, игры на деньги с выводом, игра ферма с выводом денег, игры с возможностью вывода денег, игры с выводом средств, ферма игра с выводом средств.">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  
	  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	  
      <!-- Css -->
      <link href="promo/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
      <link href="promo/css/base.css" rel="stylesheet" type="text/css" media="all"/>
      <link href="promo/css/main.css" rel="stylesheet" type="text/css" media="all"/>
      <link href="promo/css/flexslider.css" rel="stylesheet" type="text/css"  media="all" />
      <link href="promo/css/venobox.css" rel="stylesheet" type="text/css"  media="all" />
      <link href="promo/css/fonts.css" rel="stylesheet" type="text/css"  media="all" />
      <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,700" rel="stylesheet">
   </head>
   <body>
      <!-- Preloader -->
      <div class="loader">
         <!-- Preloader inner -->
         <div class="loader-inner">
            <svg width="120" height="220" viewbox="0 0 100 100" class="loading-spinner" version="1.1" xmlns="http://www.w3.org/2000/svg">
               <circle class="spinner" cx="50" cy="50" r="21" fill="#ffffff" stroke-width="2"/>
            </svg>
         </div>
         <!-- End preloader inner -->
      </div>
      <!-- End preloader-->
      <!--Wrapper-->
      <div class="wrapper">
         <!--Hero section-->
         <section class="hero overlay">
            <!--Main slider-->
            <div class="main-slider slider">
               <ul class="slides">
                  <li>
                     <div class="background-img">
                        <img src="promo/promo1.jpg" alt="">
                     </div>
                  </li>
               </ul>
            </div>
            <!--End main slider-->
            <!--Header-->
            <header class="header">
               <!--Container-->
               <div class="container ">
                  <!--Row-->
                  <div class="row">
                     <div class="col-md-3 col-sm-6 ">
                        <a class="scroll logo" href="/">
                           <h2 class="white mb-0">Realty<b style="color:#FB9337;">Money</b></h2>
                        </a>
                     </div>
                     <div class="col-md-3 text-right col-sm-6 col-md-push-6 ">
                        <?php if(!$user['id']) { ?>
							<a href="signin.php" class="but round scroll">Вход в систему</a>
						<?php } else { ?>
							<a href="profile.php" class="but round scroll">Мой аккаунт</a>
						<?php } ?>
                     </div>
                     <div class="col-md-6 text-center col-md-pull-3 col-sm-12">
                        <nav class="main-nav">
                           <div class="toggle-mobile-but">
                              <a href="#" class="mobile-but" >
                                 <div class="lines"></div>
                              </a>
                           </div>
                           <ul>
                              <li><a class="scroll" href="#about">О проекте</a></li>
                              <li><a class="scroll" href="#pricing">Почему мы?</a></li>
                              <li><a class="scroll" href="#contact">Контакты</a></li>
                              <li><a class="scroll" href="mark.php">Маркетинг</a></li>
                              <li><a class="scroll" href="stat.php">Статистика</a></li>
                              <li><a class="scroll" href="video.php">Видео</a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
                  <!--End row-->
               </div>
               <!--End container-->
            </header>
            <!--End header-->
            <!--Inner hero-->
            <div class="inner-hero">
               <!--Container-->
               <div class="container hero-content">
                  <!--Row-->
                  <div class="row vertical-align">
                     <div class="col-md-6">
                        <h1 class="white italic mb-0">Зарабатывай с нами!</h1>
                        <h5 class="white mb-0">Окунитесь с головой в уникальный игровой механизм экономической игры с выводом денег realty-money.ru!</h5>
                     </div>
                     <div class="col-md-6">
                        <div class="block-subscribe">
                           <p>Каждому новому участнику проекта мы дарим в подарок 10 руб. Ознакомьтесь с нашим замечательным проектом в полном обьеме! <span class="bold colored">100% на вывод</span></p>
                          <iframe name="Frame" style="display:none;"></iframe>
						<form class="suscribe-form form" accept-charset="utf-8" action="" method="post" target="Frame">
                              <input placeholder="Ваша почта" value=""  name="email" type="email" >
                              <input placeholder="Ваш логин" value="" name="login" type="text">
                              <input placeholder="Пароль" value="" name="pass" type="password">
                              <input value="Зарегистрироваться" class=" but submit" type="submit" name="reg">
                              <span>Нажимая кнопку «Зарегистрироваться» Вы подтверждаете, что вам исполнилось 18 лет, с <a href="terms.php" target="_blank">правилами проекта</a> ознакомлены и принимаете их.</span>
							  <?php if(!$user['id']) { ?>
									<input onclick="window.location.href='signin.php';" type="submit" class="but submit" value="Вход в систему" style="margin-top:20px; background:#50662c;">
								<?php } else { ?>
									<input onclick="window.location.href='profile.php';" type="submit" class="but submit" value="Мой аккаунт" style="margin-top:20px; background:#50662c;">
								<?php } ?>
                           </form>
						   <?php
								if(isset($_POST['reg'])) {
									$login = mysqli_real_escape_string($mysqli, $_POST['login']);
									$pass = mysqli_real_escape_string($mysqli, $_POST['pass']);
									$email = mysqli_real_escape_string($mysqli, $_POST['email']);							
									$r_log = mysqli_query($mysqli, "select `login` from `users` where `login` = '".$login."'");
									$a_log = mysqli_fetch_array($r_log);
									$r_log_em = mysqli_query($mysqli, "select `email` from `users` where `email` = '".$email."'");
									$a_log_em = mysqli_fetch_array($r_log_em);
									$r_ip_em = mysqli_query($mysqli, "select `ip_reg` from `users` where `ip_reg` = '".$_SERVER["REMOTE_ADDR"]."'");
									$a_ip_em = mysqli_fetch_array($r_ip_em);
									
									if(!ctype_alnum($login)) {
										echo '<script type="text/javascript">top.alert("Логин должен состоять только из букв и цифр.");</script>';
									} else if(!ctype_alnum($pass)) {
										echo '<script type="text/javascript">top.alert("Пароль должен состоять только из букв и цифр.");</script>';
									} else if(empty($login) or $login == ' ') {
										echo '<script type="text/javascript">top.alert("Логин не заполнен");</script>';
									} else if(empty($email) or $email == ' ') {
										echo '<script type="text/javascript">top.alert("E-mail не заполнен");</script>';
									} else if(empty($pass) or $pass == ' ') {
										echo '<script type="text/javascript">top.alert("Пароль не может быть пустым");</script>';
									} else {
										if(mb_strtolower($email) == mb_strtolower($a_log_em['email'])) {
											echo '<script type="text/javascript">top.alert("На данный e-mail уже зарегистрирован пользователь!");</script>';
										} else if(mb_strtolower($login) == mb_strtolower($a_log['login'])) {
											echo '<script type="text/javascript">top.alert("Пользователь с таким логином уже существует!");</script>';
										} else if(mb_strtolower($_SERVER["REMOTE_ADDR"]) == mb_strtolower($a_ip_em['ip_reg'])) {
											echo '<script type="text/javascript">top.alert("С данного IP адреса уже была произведена регистрация!");</script>';
										} else {										
											mysqli_query($mysqli, "INSERT INTO `users` (`login`, `pass`, `email`, `ref`, `date_reg`, `ip_reg`, `UserAgent`, `money_pok`, `date_vh`) VALUES ('".$login."', '".$pass."', '".$email."', '".$_SESSION['ref']."', '". date("Y-m-d H:i:s") ."', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["HTTP_USER_AGENT"]."', '10', '". date("Y-m-d H:i:s") ."') ") or die(mysqli_error());									
											$_SESSION['user'] = $login;
											$_SESSION['pass'] = $pass;									
											echo '<script type="text/javascript">top.window.location.href="profile.php";</script>';
										}						
									}
								}
							?>
                        </div>
                     </div>
                  </div>
                  <!--End row-->
               </div>
               <!--End container-->
            </div>
            <!--End inner hero-->
         </section>
         <!--End hero section-->
		 
		 
		 <!--About section-->
         <section id="about" class="about main  ">
            <!--Container-->
            <div class="container ">
               <!--Row-->
               <div class="row ">
                  <div class="col-sm-12 ">
                     <div class="block-boxed bg-dark-1 gap-double">
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                           <h2 class="white italic">С нами надежно!</h2>
                           <p>Увлекательный игровой симулятор с возможностью заработка и вывода реальных денег! Все что от Вас требуется это зарегистрироваться в нашем проекте, строить недвижимость и получать стабильный доход!</p>
                           
                           <blockquote class="testimonial mb-0 text-center">
                              <h6 class="colored bg bold mb-0">Нет баллов, лимитов и др. ограничений</h6>
                           </blockquote>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
            <!--Container-->
            <div class="container ">
               <!--Row-->
               <div class="row ">
                  <div class="col-sm-12 ">
                     <div class="block-boxed bg-dark-2">
                        <i class="icon-trophy icon"></i>
                        <div>
                           <div class="col-sm-6 text-center">
							<?php
								$users_all = mysqli_fetch_array(mysqli_query($mysqli, "SELECT COUNT(`id`) as `count` FROM `users`"));
							?>
                              <h1 class=" italic grey mb-0"><?php echo number_format($users_all['count'], 0 ,'', ' ');?></h1>
                              <p class="white">
                                Всего участников, чел.
                              </p>
                           </div>
                           <div class="col-sm-6 text-center">
							<?php
								$money_all = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(`money`) as `sum` FROM `users_money`"));
							?>
                              <h1 class="grey italic mb-0"><?php echo number_format($money_all['sum'], 0 ,'', ' ');?></h1>
                              <p class="white">
                                 Сумма пополнений, руб.
                              </p>
                           </div>
                           <div class="col-sm-6 text-center">
							<?php
								$vivod_all = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(`money`) as `sum` FROM `users_vivod`"));
							?>
                              <h1 class="grey italic mb-0"><?php echo number_format($vivod_all['sum'], 0 ,'', ' ');?></h1>
                              <p class="white">
                                 Заработано участниками, руб.
                           </div>
                           <div class="col-sm-6 text-center">
                              <h1 class="grey italic mb-0">
								<script type="text/javascript">
									d0 = new Date('March 02, 2018');
									d1 = new Date();
									dt = (d1.getTime() - d0.getTime()) / (1000*60*60*24);
									document.write(Math.round(dt));
								</script>
							  </h1>
                              <p class="white">
                                 Время работы, дней
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
            
         </section>
         <!--End about section-->
		 
		 
		 <!-- Реклама -->
         <section id="contact"  class="contact" style="padding-bottom:7em;">
			<div class="container">
               <!--Row-->
               <div class="row block-enhanced">
                  <div class="col-md-6 enhanced">
                     <div id="linkslot_204697" style="margin:0 auto;"><script src="https://linkslot.ru/bancode.php?id=204697" async></script></div>
                  </div>
                  <div class="col-md-6 enhanced">
                    <div id="linkslot_204698" style="margin:0 auto;"><script src="https://linkslot.ru/bancode.php?id=204698" async></script></div>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
         </section>
         <!--End реклама-->
		 
		 
         <!--Divider section-->
         <section class="divider large">
            <div class="background-img" >
               <img src="promo/promo2.jpg" alt="">
            </div>
            <!--Container-->
            <div class="container">
               <!--Row-->
               <div class="row">
                  <div class="col-md-8 col-md-offset-2 text-center  front-p">
                     <h2 class="white italic">Начни зарабатывать прямо сейчас!</h2>
                     <p class="white lead">Именно в нашем проекте можно не только увлекательно проводить время но и зарабатывать деньги! Статистика проекта открыта для всех пользователей. Анализируйте и принимайте решения самостоятельно!</p>
                     <a class="but scroll" href="signup.php">Зарегистрироваться</a>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
         </section>
         <!--End divider section-->
         
        
         <!--Stories section-->
         <section id="stories" class="stories main  ">
            
            <!--Container-->
            <div id="pricing" class="pricing container gap-double">
               <!--Row-->
               <div class="row vertical-align">
                  <div class="col-md-4 text-center">
                     <div class="block-member">
                        <h6 class="mb-0 h6 light">Стабильный допонительный доход</h6>
                        <h3 class="italic">Быстрая окупаемость</h3>
                        <div class="block-price">
                           <span class="dollar italic colored">до</span>
                           <span class="price colored bold">35</span>
                           <span class="terms italic colored ">% в месяц</span>
                        </div>
                        <h6 class="h6">подарок - 10 руб.</h6>
                        <a href="signup.php" class="but round lg">Зарегистрироваться</a>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="col-sm-6">
                        <div class="block-feature">
                           <i class="icon-wrench icon"></i>
                           <div class="block-body">
                              <h4 class="bold italic mb-0">СОБСТВЕННЫЙ СКРИПТ</h4>
                              <p>Мы используем уникальный скрипт собственной разработки, сайт создавался полностью с нуля.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="block-feature">
                           <i class="icon-chart-pie-1 icon"></i>
                           <div class="block-body">
                              <h4 class="bold italic mb-0">ОТКРЫТАЯ СТАТИСТИКА</h4>
                              <p>Статистика проекта всегда открыта и доступна для просмотра любому пользователю проекта.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="block-feature">
                           <i class="icon-desktop icon"></i>
                           <div class="block-body">
                              <h4 class="bold italic mb-0">НАДЕЖНЫЙ СЕРВЕР</h4>
                              <p>Проект размещен на выделенном, защищенном сервере, что обеспечит максимальную доступность.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="block-feature">
                           <i class="icon-key icon"></i>
                           <div class="block-body">
                              <h4 class="bold italic mb-0">SSL СЕРТИФИКАТ</h4>
                              <p>Мы имеем сертификат надежности, ваши данные никогда не попадут в руки злоумышленников.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="block-feature">
                           <i class="icon-mobile icon"></i>
                           <div class="block-body">
                              <h4 class="bold italic mb-0">МОБИЛЬНАЯ ВЕРСИЯ</h4>
                              <p>Сайт доступен с любых мобильных устройств, и будет масштабироваться под Ваше разрешение экрана.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="block-feature">
                           <i class="icon-chart-bar icon"></i>
                           <div class="block-body">
                              <h4 class="bold italic mb-0">ПЛАВНЫЙ МАРКЕТИНГ</h4>
                              <p>Благодаря плавному и продуманному маркетингу realtymoney обещает стать настоящим долгожителем.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
            <!--Container-->
            <div class=" container ">
               <!--Row-->
               <div class="row ">
                  <div class="col-md-12 text-center">
                     <h2 class="italic mb-0">Как можно заработать в проекте RealtyMoney?</h2>
                     <p class="mb-0">В нашем проекте существует несколько способов заработка:<br>развитие своей недвижимости, просмотр сайтов в сёрфинге, реферальная программа и т.д.<br>Выводить можно ровно столько, сколько заработали на проекте, без каких-либо ограничений.</p>
                  </div>
                 </div>
				 <div class="row ">
                  <div class="col-md-12 text-center">
                     <h2 class="italic mb-0"><br>Партнерская программа</h2>
                     <p class="mb-0">Партнерская программа в RealtyMoney имеет 2 уровня, заработок с партнерской программы перечисляется на счет для вывода.<br>Вы будете получать <span class="bold colored">7% с рефералов 1 уровня</span>, и <span class="bold colored">3% с рефералов 2 уровня</span>.</p>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
         </section>
         <!--End stories section-->
		 
		 
		 <!--Contact section-->
         <section id="contact"  class="contact main ">
            <!--Container-->
            <div class="container ">
               <!--Row-->
               <div class="row ">
                  <div class="col-md-12  gap-one text-center">
                     <h2 class=" italic mb-0">Всегда на связи</h2>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
            <!--Container-->
            <div class="container">
               <!--Row-->
               <div class="row block-enhanced">
                  <div class="col-md-6 enhanced">
                     <div class="background-img" >
                        <img src="promo/promo3.jpg" alt="">
                     </div>
                  </div>
                  <div class="col-md-6 enhanced">
                     <div class="block-boxe block-contact">
                        <h4 class="bold italic white">Мы рады Вам помочь!</h4>
                        <p class="lead white">
                           Возникли вопросы или есть проблема?<br>
						   Свяжитесь с нашей техподдержкой.
                           <br><br>
                           ВК: <a href="https://vk.com/realty_money" target="_blank">https://vk.com/realty_money</a><br>
                           Email : support@realty-money.ru
						    <br><br>
							<a href="calc.php">Калькулятор прибыли</a>
                        </p>
                     </div>
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
         </section>
         <!--End contact section-->
        
         
        
         
         <footer class="footer gap-one">
            <!--Container-->
            <div class="container ">
               <!--Row-->
               <div class="row ">
                  <div class="col-md-12   text-center">
                     <p class="mb-0 size-sm">Copyrights ©2018 realty-money.ru All rights reserved.<br>Игра предназначена для лиц старше 18 лет. <a href="terms.php">Правила проекта</a>
						<br><br>
						<a href="https://payeer.com/02487719" title="Платежный агрегатор Payeer" target="_blank"><img src="img/Payeer.gif" alt="Payeer" style="width:88px; height:31px;"/></a> <a href="https://money.yandex.ru/" title="Яндекс.Деньги" target="_blank"><img src="img/yandex.jpg" alt="Яндекс.Деньги" style="width:88px; height:31px;"/></a> <!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=47858708&amp;from=informer" target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/47858708/3_1_FFFFFFFF_EFEFEFFF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="47858708" data-lang="ru" /></a> <!-- /Yandex.Metrika informer --> <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter47858708 = new Ya.Metrika({ id:47858708, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47858708" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
						
						<br><br>
						
						<a href="https://mmgp.ru/showthread.php?t=570328" title="MMGP - Форум о заработке в Интернете и интернет-инвестировании" target="_blank"> <img src="img/monit/mmgp.gif" alt="MMGP - Форум о заработке в Интернете и интернет-инвестировании"></a> <a href="https://clck.ru/CtegU" title="MoneyMaker.team Делаем Деньги Вместе" target="_blank"> <img src="img/monit/moneymaker.jpg" alt="MoneyMaker.team Делаем Деньги Вместе"></a> <a href="https://clck.ru/Ctes3" title="ProfitHunters.ru - Форум о заработке и инвестициях в интернете" target="_blank"> <img src="img/monit/profithunters.jpg" alt="ProfitHunters.ru - Форум о заработке и инвестициях в интернете"></a> <a href="https://finforum.net/threads/realty-money-ru-realty-money.14230/" title="FinForum - Финансовый форум" target="_blank"> <img src="img/monit/finforum.jpg" alt="FinForum - Финансовый форум"></a> <a href="https://clck.ru/CttbK" title="Antimmgp.ru - заработок в Интернете, инвестиции и отзывы в Интернет" target="_blank"> <img src="img/monit/antimmgp.jpg" alt="Antimmgp.ru - заработок в Интернете, инвестиции и отзывы в Интернет"></a>
						
						<br><br>

						<a href="https://clck.ru/CvFJk" title="well-money.ru - Игры с выводом денег" target="_blank"><img src="img/monit/well2.gif" alt="well-money.ru - Игры с выводом денег"></a> <a href="https://clck.ru/Cx23X" target="_blank"><img src="img/monit/160805-gamedom-88x31.gif" alt="GAMEDOM - ИГРЫ КОТОРЫЕ ПЛАТЯТ" width="88" height="31" border="0" /></a> <a href="https://mywmz.net/zarabotok-na-igrax" target="_blank"><img src="https://mywmz.net/wp-content/uploads/2017/05/M-88.gif"  width="88" height="31"/></a> <a href="https://moniktop.ru/ferma-info/412" title="MonikTop.ru - Мониторинг проектов с выводом денег" target="_blank"><img src="https://moniktop.ru/img/knopki_ferm/412.gif" alt="MonikTop.ru - Мониторинг проектов с выводом денег"></a> <a href="http://netweb-monitor.ru/ferm_new/728" title="netWEB-monitor.ru - Мониторинг игр с выводом денег" target="_blank"><img src="img/monit/pay1.gif" alt="netWEB-monitor.ru - Мониторинг игр с выводом денег"></a> <a href="https://monitorgame.com/game-page/RealtyMoney" target="_blank"><img src="https://monitorgame.com/m/images/9b7a2414d0e8a386dd468f9de868db04.jpg"></a> <a href="https://clck.ru/Cw9ut" target="_blank"><img src="img/monit/547.gif" width="88" height="31" border="0"></a> <a href="https://clck.ru/CteeC" target="_blank"><img src="img/monit/knopka.gif" width="88" height="31" border="0"></a> <a href="https://clck.ru/CteeJ" title="OroHyipRus - Проверено игра Платит!" target="_blank"> <img src="img/monit/88x31.gif" alt="OroHyipRus - Проверено игра Платит!"></a> <a href="https://clck.ru/Cteet" title="MonitorGam - Проверено игра Платит!" target="_blank"> <img src="img/monit/platit.gif" alt="MonitorGam - Проверено игра Платит!"></a> <a href="https://clck.ru/CtgpW" title="Мониторинг игр с выводом денег" target="_blank"> <img src="img/monit/knopka1.gif" alt="Мониторинг игр с выводом денег"></a> <a href="https://clck.ru/CuRut" title="Hyipgamesearn.ru  - мониторинг игр с выводом денег!" target="_blank"> <img src='img/monit/MF-88.gif' alt="Hyipgamesearn.ru - мониторинг игр с выводом денег!"></a> <a href="https://clck.ru/CuxFg" title="Игры с выводом денег" target="_blank"> <img src='img/monit/igra-platit.gif' alt="Игры с выводом денег"></a>
						
						

                     </p>
                    
                  </div>
               </div>
               <!--End row-->
            </div>
            <!--End container-->
         </footer>
      </div>
      <!-- End wrapper-->
      <!--Javascript-->	
      <script src="promo/js/jquery-1.12.4.min.js" type="text/javascript"></script>
      <script src="promo/js/jquery.flexslider-min.js" type="text/javascript"></script>
      <script src="promo/js/smooth-scroll.js" type="text/javascript"></script>
      <script src="promo/js/placeholders.min.js" type="text/javascript"></script>
      <script src="promo/js/venobox.min.js" type="text/javascript"></script>
      <script src="promo/js/instafeed.min.js" type="text/javascript"></script>
      <script src="promo/js/script.js" type="text/javascript"></script>
      <!-- Google analytics -->
      <!-- End google analytics -->
   </body>
</html>

