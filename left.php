<?php
$ul = mysqli_fetch_array(mysqli_query($mysqli, "SELECT `id`, `money_pok`, `money_viv` FROM `users` WHERE `login`='".$_SESSION['user']."' and `pass`='".$_SESSION['pass']."'"));

// Определяем URL страницы
$url = $_SERVER["REQUEST_URI"];
$url = str_replace("https://", "", $url);
$url = str_replace("http://", "", $url);
$urls = explode('/', $url);
$urel = (array_key_exists(1, $urls) ? $urls[1] : '/');
?>
<div class="am-sideleft">
	<ul class="nav am-sideleft-tab">
		<li class="nav-item">
			<a href="#mainMenu" class="nav-link <?php if($urel == 'konk2.php' or $urel == 'konk1.php') {} else { echo ' active '; } ?>"><i class="icon ion-ios-home-outline tx-24"></i></a>
		</li>
		<li class="nav-item">
			<a href="#emailMenu" class="nav-link"><i class="icon ion-medkit tx-24"></i></a>
		</li>
		<li class="nav-item">
			<a href="#chatMenu" class="nav-link"><i class="icon ion-stats-bars tx-24"></i></a>
		</li>
		<li class="nav-item">
			<a href="#settingMenu" class="nav-link <?php if($urel == 'konk2.php' or $urel == 'konk1.php') { echo ' active '; } ?>"><i class="icon ion-paintbrush tx-24"></i></a>
		</li>
	</ul>

	<div class="tab-content">
		
		<div id="mainMenu" class="tab-pane <?php if($urel == 'konk2.php' or $urel == 'konk1.php') {} else { echo ' active '; } ?>">
		
			<!-- &#8381; -->
			<table class="table table-hover tx-13">
				<tbody>
					<tr>
						<td> <i class="icon ion-reply-all"></i> &nbsp; На покупки:</td>
						<td><code><?php echo number_format(0+$ul['money_pok'], 2, '.', ' '); ?> Р</code></td>
					</tr>
					<tr>
						<td> <i class="icon ion-share"></i> &nbsp; На вывод:</td>
						<td><code><?php echo number_format(0+$ul['money_viv'], 4, '.', ' '); ?> Р</code></td>
					</tr>
					<tr>
						<?php
							$money_rek = mysqli_fetch_array(mysqli_query($mysqli, "SELECT SUM(`money`) as `sum` FROM `serf_add` WHERE `id_users`='".$ul['id']."'"));
						?>
						<td> <i class="icon ion-funnel"></i> &nbsp; На рекламу:</td>
						<td><code><?php echo number_format(0+$money_rek['sum'], 4, '.', ' '); ?> Р</code></td>
					</tr>
				</tbody>
			</table>
				
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="profile.php" class="nav-link <?php if($urel == 'profile.php') { echo ' active '; } ?>"><i class="icon ion-ios-person-outline"></i><span>Профиль</span></a>
				</li>
				<li class="nav-item">
					<a href="mat.php" class="nav-link <?php if($urel == 'mat.php') { echo ' active '; } ?>"><i class="icon ion-ios-home-outline"></i><span>Недвижимость</span></a>
				</li>
				<li class="nav-item">
					<a href="bonus.php" class="nav-link <?php if($urel == 'bonus.php') { echo ' active '; } ?>"><i class="icon ion-wand"></i><span>Ежедневный бонус</span></a>
				</li>
			</ul>
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="bonus_dop.php" class="nav-link <?php if($urel == 'bonus_dop.php') { echo ' active '; } ?>"><i class="icon ion-contrast"></i><span>Доп. бонусы <b><sup>new</sup></b></span></a>
				</li>
				<li class="nav-item">
					<a href="ruletka.php" class="nav-link <?php if($urel == 'ruletka.php') { echo ' active '; } ?>"><i class="icon ion-pinpoint"></i><span>Попытай удачу</span></a>
				</li>
				<li class="nav-item">
					<a href="poker.php" class="nav-link <?php if($urel == 'poker.php') { echo ' active '; } ?>"><i class="icon ion-bookmark"></i><span>В 200 раз больше</span></a>
				</li>
			</ul>
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="money_pop.php" class="nav-link <?php if($urel == 'money_pop.php') { echo ' active '; } ?>"><i class="icon ion-reply-all"></i><span>Пополнить баланс <b><sup>+10%</sup></b></span></a>
				</li>
				<li class="nav-item">
					<a href="vivod.php" class="nav-link <?php if($urel == 'vivod.php') { echo ' active '; } ?>"><i class="icon ion-share"></i><span>Заказать выплату</span></a>
				</li>
				<li class="nav-item">
					<a href="obmen.php" class="nav-link <?php if($urel == 'obmen.php') { echo ' active '; } ?>"><i class="icon ion-loop"></i><span>Обмен баланса</span></a>
				</li>
			</ul>
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="serf_view.php" class="nav-link <?php if($urel == 'serf_view.php') { echo ' active '; } ?>"><i class="icon ion-images"></i><span>Серфинг сайтов</span></a>
				</li>
				<li class="nav-item">
					<a href="serf_add.php" class="nav-link <?php if($urel == 'serf_add.php') { echo ' active '; } ?>"><i class="icon ion-arrow-right-a"></i><span>Добавить сайт</span></a>
				</li>
				<li class="nav-item">
					<a href="serf_my.php" class="nav-link <?php if($urel == 'serf_my.php') { echo ' active '; } ?>"><i class="icon ion-filing"></i><span>Управление серфингом</span></a>
				</li>
			</ul>
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="pmat.php" class="nav-link <?php if($urel == 'pmat.php') { echo ' active '; } ?>"><i class="icon ion-link"></i><span>Партнерская программа</span></a>
				</li>
				<li class="nav-item">
					<a href="ref.php" class="nav-link <?php if($urel == 'ref.php') { echo ' active '; } ?>"><i class="icon ion-person-stalker"></i><span>Список рефералов</span></a>
				</li>
				<li class="nav-item">
					<a href="news.php" class="nav-link <?php if($urel == 'news.php') { echo ' active '; } ?>"><i class="icon ion-document-text"></i><span>Новости</span></a>
				</li>
			</ul>
		</div>
		
		<div id="emailMenu" class="tab-pane">
			<div class="pd-x-20 pd-y-10">
				<a href="mailto:support@realty-money.ru" class="btn btn-orange btn-block btn-compose">Техподдержка</a>
			</div>
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="https://realty-money.ru/#contact" class="nav-link">
						<i class="icon ion-help-circled"></i>
						<span>Помощь</span>
					</a>
				</li>
				<!--<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="icon ion-clipboard"></i>
						<span>Отзывы</span>
					</a>
				</li>-->
				<li class="nav-item">
					<a href="https://realty-money.ru/#pricing" class="nav-link">
						<i class="icon ion-pinpoint"></i>
						<span>Гарантии</span>
					</a>
				</li>
			</ul>
			<label class="pd-x-20 tx-uppercase tx-11 mg-t-10 tx-orange mg-b-0 tx-medium">&nbsp;</label>
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="https://realty-money.ru/#about" class="nav-link">
						<i class="icon ion-flag"></i>
						<span>О проекте</span>
					</a>
				</li>
			</ul>
		</div>
		
		<div id="chatMenu" class="tab-pane">
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="stat.php" class="nav-link">
						<i class="icon ion-stats-bars"></i>
						<span>Статистика</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="calc.php" class="nav-link">
						<i class="icon ion-calculator"></i>
						<span>Калькулятор дохода</span>
					</a>
				</li>
			</ul>
		</div>
	
		<div id="settingMenu" class="tab-pane <?php if($urel == 'konk2.php' or $urel == 'konk1.php') { echo ' active '; } ?>">
			<ul class="nav am-sideleft-menu">
				<li class="nav-item">
					<a href="konk1.php" class="nav-link <?php if($urel == 'konk1.php') { echo ' active '; } ?>">
						<i class="icon ion-person-stalker"></i>
						<span>Конкурс рефералов</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="konk2.php" class="nav-link <?php if($urel == 'konk2.php') { echo ' active '; } ?>">
						<i class="icon ion-person-add"></i>
						<span>Конкурс инвесторов</span>
					</a>
				</li>
			</ul>
			<label class="pd-x-15 tx-uppercase tx-11 mg-t-20 tx-orange mg-b-10 tx-medium">Список конкурсов</label>
			<div class="list-group list-group-chat">
				<a class="list-group-item">
					<p>Конкурсы - это отличная возможность для активных участников проекта заработать поощрительные призы за их активность.</p>
					<p>За призы в конкурсах может побороться любой из пользователей проекта.</p>
					<p><b>Призы выплачиваются на баланс для вывода.</b></p>
				</a>
			</div>
		</div>
	
	
	</div>
	
</div>