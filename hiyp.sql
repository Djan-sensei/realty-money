-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 12 2018 г., 14:30
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `id_mast` int(255) NOT NULL,
  `id_num` int(255) NOT NULL,
  `pic` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `name`, `id_mast`, `id_num`, `pic`) VALUES
(1, 'Млекопит(пики) - 2', 1, 1, 'img/carts/vini/2.png'),
(2, 'Млекопит(пики) - 3', 1, 2, 'img/carts/vini/3.png'),
(3, 'Млекопит(пики) - 4', 1, 3, 'img/carts/vini/4.png'),
(4, 'Млекопит(пики) - 5', 1, 4, 'img/carts/vini/5.png'),
(5, 'Млекопит(пики) - 6', 1, 5, 'img/carts/vini/6.png'),
(6, 'Млекопит(пики) - 7', 1, 6, 'img/carts/vini/7.png'),
(7, 'Млекопит(пики) - 8', 1, 7, 'img/carts/vini/8.png'),
(8, 'Млекопит(пики) - 9', 1, 8, 'img/carts/vini/9.png'),
(9, 'Млекопит(пики) - 10', 1, 9, 'img/carts/vini/10.png'),
(10, 'Млекопит(пики) - Валет', 1, 10, 'img/carts/vini/Валет.png'),
(11, 'Млекопит(пики) - Дама', 1, 11, 'img/carts/vini/Дама.png'),
(12, 'Млекопит(пики) - Король', 1, 12, 'img/carts/vini/Король.png'),
(13, 'Млекопит(пики) - Туз', 1, 13, 'img/carts/vini/Туз.png'),
(14, 'Птицы(крести) - 2', 2, 1, 'img/carts/krest/2.png'),
(15, 'Птицы(крести) - 3', 2, 2, 'img/carts/krest/3.png'),
(16, 'Птицы(крести) - 4', 2, 3, 'img/carts/krest/4.png'),
(17, 'Птицы(крести) - 5', 2, 4, 'img/carts/krest/5.png'),
(18, 'Птицы(крести) - 6', 2, 5, 'img/carts/krest/6.png'),
(19, 'Птицы(крести) - 7', 2, 6, 'img/carts/krest/7.png'),
(20, 'Птицы(крести) - 8', 2, 7, 'img/carts/krest/8.png'),
(21, 'Птицы(крести) - 9', 2, 8, 'img/carts/krest/9.png'),
(22, 'Птицы(крести) - 10', 2, 9, 'img/carts/krest/10.png'),
(23, 'Птицы(крести) - Валет', 2, 10, 'img/carts/krest/Валет.png'),
(24, 'Птицы(крести) - Дама', 2, 11, 'img/carts/krest/Дама.png'),
(25, 'Птицы(крести) - Король', 2, 12, 'img/carts/krest/Король.png'),
(26, 'Птицы(крести) - Туз', 2, 13, 'img/carts/krest/Туз.png'),
(27, 'Растения(черви) - 2', 3, 1, 'img/carts/cherv/2.png'),
(28, 'Растения(черви) - 3', 3, 2, 'img/carts/cherv/3.png'),
(29, 'Растения(черви) - 4', 3, 3, 'img/carts/cherv/4.png'),
(30, 'Растения(черви) - 5', 3, 4, 'img/carts/cherv/5.png'),
(31, 'Растения(черви) - 6', 3, 5, 'img/carts/cherv/6.png'),
(32, 'Растения(черви) - 7', 3, 6, 'img/carts/cherv/7.png'),
(33, 'Растения(черви) - 8', 3, 7, 'img/carts/cherv/8.png'),
(34, 'Растения(черви) - 9', 3, 8, 'img/carts/cherv/9.png'),
(35, 'Растения(черви) - 10', 3, 9, 'img/carts/cherv/10.png'),
(36, 'Растения(черви) - Валет', 3, 10, 'img/carts/cherv/Валет.png'),
(37, 'Растения(черви) - Дама', 3, 11, 'img/carts/cherv/Дама.png'),
(38, 'Растения(черви) - Король', 3, 12, 'img/carts/cherv/Король.png'),
(39, 'Растения(черви) - Туз', 3, 13, 'img/carts/cherv/Туз.png'),
(40, 'Рыбы(буби) - 2', 4, 1, 'img/carts/bubi/2.png'),
(41, 'Рыбы(буби) - 3', 4, 2, 'img/carts/bubi/3.png'),
(42, 'Рыбы(буби) - 4', 4, 3, 'img/carts/bubi/4.png'),
(43, 'Рыбы(буби) - 5', 4, 4, 'img/carts/bubi/5.png'),
(44, 'Рыбы(буби) - 6', 4, 5, 'img/carts/bubi/6.png'),
(45, 'Рыбы(буби) - 7', 4, 6, 'img/carts/bubi/7.png'),
(46, 'Рыбы(буби) - 8', 4, 7, 'img/carts/bubi/8.png'),
(47, 'Рыбы(буби) - 9', 4, 8, 'img/carts/bubi/9.png'),
(48, 'Рыбы(буби) - 10', 4, 9, 'img/carts/bubi/10.png'),
(49, 'Рыбы(буби) - Валет', 4, 10, 'img/carts/bubi/Валет.png'),
(50, 'Рыбы(буби) - Дама', 4, 11, 'img/carts/bubi/Дама.png'),
(51, 'Рыбы(буби) - Король', 4, 12, 'img/carts/bubi/Король.png'),
(52, 'Рыбы(буби) - Туз', 4, 13, 'img/carts/bubi/Туз.png');

-- --------------------------------------------------------

--
-- Структура таблицы `dvizh`
--

CREATE TABLE IF NOT EXISTS `dvizh` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `money` varchar(300) NOT NULL,
  `otkogo` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `info` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=461 DEFAULT CHARSET=utf8;


--
-- Структура таблицы `konk`
--

CREATE TABLE IF NOT EXISTS `konk` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `priz1` int(11) NOT NULL,
  `priz2` int(11) NOT NULL,
  `priz3` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `type` int(255) NOT NULL,
  `end` int(255) NOT NULL,
  `pob1` int(255) NOT NULL,
  `pob2` int(255) NOT NULL,
  `pob3` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `mat`
--

CREATE TABLE IF NOT EXISTS `mat` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `img` varchar(300) NOT NULL,
  `price` int(255) NOT NULL,
  `dohod` varchar(300) NOT NULL,
  `speed` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mat`
--

INSERT INTO `mat` (`id`, `name`, `img`, `price`, `dohod`, `speed`) VALUES
(1, 'Садовый домик', 'img/mat/001.png', 10, '25', '0.0034'),
(2, 'Дачный дом', 'img/mat/002.png', 50, '26', '0.018'),
(3, 'Коттедж', 'img/mat/003.png', 250, '27', '0.093'),
(4, 'Усадьба', 'img/mat/004.png', 1000, '28', '0.38'),
(5, 'Почтамт', 'img/mat/005.png', 3000, '29', '1.2'),
(6, 'Офисное здание', 'img/mat/006.png', 5000, '30.5', '2.12'),
(7, 'Больница', 'img/mat/007.png', 7500, '31', '3.22'),
(8, 'Производство', 'img/mat/008.png', 12500, '32', '5.55'),
(9, 'Банк', 'img/mat/009.png', 20000, '33', '9.16'),
(10, 'Высотка', 'img/mat/010.png', 50000, '35', '24.3');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `text`, `date`) VALUES
(1, 'Бонусы от пополнения', 'Получайте бонус к пополнению!<br>\r\nот 500 руб. - <code>3% от суммы пополнения</code><br>\r\nот 1000 руб. - <code>5% от суммы пополнения</code><br>\r\nот 5000 руб. - <code>7% от суммы пополнения</code><br>\r\nот 10000 руб. - <code>10% от суммы пополнения</code>', '2018-03-16 10:40:21'),
(2, 'Старт проекта', 'Доброго времени дня! Вот и состоялся долгожданный запуск проекта. Данная игра расчитана на долгую стабильную работу, она станет для Вас надежным и стабильным источником дохода. Отличная партнерская программа, серфинг и доход с недвижимости 100% на вывод. Всем стабильного дохода. ', '2018-03-01 13:50:32'),
(3, 'Конкурсы', 'Запущены конкурс рефералов и конкурс инвесторов. Призовой фонд каждого конкурса составляет 1800 руб. Призы начисляются на счет для вывода.', '2018-03-02 12:00:00'),
(4, 'С Днем 8 марта, Милые Дамы!', 'В этот день Милым Дамам желаем: Много счастья, любви, здоровья и всего самого наилучшего. С 8 Марта мы Вас поздравляем! Пусть удача Вам будет верна. В честь праздника <code>+6% на все пополнения</code>!', '2018-03-08 10:00:00'),
(5, 'Технические работы!', 'Уважаемые участники!<br>В данный момент на сайте идут технические работы, возможны перебои с доступом.<br>Приносим извинения за неудобства!', '2018-03-15 16:12:11'),
(6, 'Завершение технических работ!', 'Работы окончены, работа сайта восстановлена. Спасибо за ожидание!', '2018-03-15 19:43:12');

-- --------------------------------------------------------

--
-- Структура таблицы `num`
--

CREATE TABLE IF NOT EXISTS `num` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `num`
--

INSERT INTO `num` (`id`, `name`) VALUES
(1, '2'),
(2, '3'),
(3, '4'),
(4, '5'),
(5, '6'),
(6, '7'),
(7, '8'),
(8, '9'),
(9, '10'),
(10, 'валет'),
(11, 'дама'),
(12, 'король'),
(13, 'туз');

-- --------------------------------------------------------

--
-- Структура таблицы `poker`
--

CREATE TABLE IF NOT EXISTS `poker` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `stavka` int(255) NOT NULL,
  `cart1` int(255) NOT NULL,
  `cart2` int(255) NOT NULL,
  `cart3` int(255) NOT NULL,
  `cart4` int(255) NOT NULL,
  `cart5` int(255) NOT NULL,
  `zamena` int(255) NOT NULL,
  `lot` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `poker_bank`
--

CREATE TABLE IF NOT EXISTS `poker_bank` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `zoloto` int(255) NOT NULL,
  `result` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `comb` int(255) NOT NULL,
  `sum` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ruletka_bank`
--

CREATE TABLE IF NOT EXISTS `ruletka_bank` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `money` varchar(300) NOT NULL,
  `result` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `priz` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=389 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `serf_add`
--

CREATE TABLE IF NOT EXISTS `serf_add` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `info` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  `time` int(255) NOT NULL,
  `color` int(255) NOT NULL,
  `link` int(255) NOT NULL,
  `id_users` int(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `views` int(255) NOT NULL,
  `money` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `serf_money`
--

CREATE TABLE IF NOT EXISTS `serf_money` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_serf` int(255) NOT NULL,
  `money` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `serf_users`
--

CREATE TABLE IF NOT EXISTS `serf_users` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_serf` int(255) NOT NULL,
  `id_users` int(255) NOT NULL,
  `time_view` datetime NOT NULL,
  `yes` int(255) NOT NULL,
  `end` int(255) NOT NULL,
  `price` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89628 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(300) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `pass_vivod` varchar(300) NOT NULL,
  `payeer` varchar(300) NOT NULL,
  `yandex` varchar(300) NOT NULL,
  `qiwi` varchar(300) NOT NULL,
  `visa` varchar(300) NOT NULL,
  `mastercard` varchar(300) NOT NULL,
  `maestro` varchar(300) NOT NULL,
  `beeline` varchar(300) NOT NULL,
  `megafon` varchar(300) NOT NULL,
  `mts` varchar(300) NOT NULL,
  `tele2` varchar(300) NOT NULL,
  `ref` int(255) NOT NULL,
  `date_reg` varchar(300) NOT NULL,
  `ip_reg` varchar(300) NOT NULL,
  `UserAgent` varchar(300) NOT NULL,
  `money_pok` varchar(300) NOT NULL,
  `money_viv` varchar(300) NOT NULL,
  `money_rek` varchar(300) NOT NULL,
  `date_vh` datetime NOT NULL,
  `ban` int(255) NOT NULL,
  `pod_code` int(255) NOT NULL,
  `pod` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5291 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `users_bonus`
--

CREATE TABLE IF NOT EXISTS `users_bonus` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `money` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23407 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `users_bonus2`
--

CREATE TABLE IF NOT EXISTS `users_bonus2` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `vk_page` varchar(300) NOT NULL,
  `prov` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=826 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_bonus_ref`
--

CREATE TABLE IF NOT EXISTS `users_bonus_ref` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `ref_kol` int(255) NOT NULL,
  `prov` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_bonus_video`
--

CREATE TABLE IF NOT EXISTS `users_bonus_video` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `link` varchar(300) NOT NULL,
  `prov` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_mat`
--

CREATE TABLE IF NOT EXISTS `users_mat` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `id_mat` int(255) NOT NULL,
  `kol` int(255) NOT NULL,
  `start` datetime NOT NULL,
  `sob` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4808 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `users_money`
--

CREATE TABLE IF NOT EXISTS `users_money` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `money` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=534 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `users_vivod`
--

CREATE TABLE IF NOT EXISTS `users_vivod` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_users` int(255) NOT NULL,
  `money` varchar(300) NOT NULL,
  `type` varchar(300) NOT NULL,
  `vup` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `prov` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2338 DEFAULT CHARSET=utf8;
