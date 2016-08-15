-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 31 2016 г., 10:45
-- Версия сервера: 5.5.44-0+deb7u1
-- Версия PHP: 5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_sto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Honda'),
(2, 'Suzuki'),
(3, 'Viper'),
(4, 'RZR'),
(5, 'Linhai');

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` smallint(5) unsigned NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `full_name`, `phone_number`) VALUES
(1, 'Володимир', '+380672700390'),
(2, 'Ніколаєвський Дмитро Едуардович', '+380977557051'),
(3, '---', '+380676331040'),
(4, 'Женя', '+380968842228'),
(5, '///', '+380932940154'),
(6, 'moto-moto.kiev.ua', '+380093000039'),
(7, 'Таня Чеботарьова', '+380665081407');

-- --------------------------------------------------------

--
-- Структура таблицы `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` smallint(5) unsigned NOT NULL,
  `client_id` smallint(5) unsigned NOT NULL,
  `vehicle_id` smallint(5) unsigned NOT NULL,
  `creator_id` smallint(5) unsigned NOT NULL COMMENT 'User id',
  `performer_id` smallint(5) unsigned DEFAULT '0' COMMENT 'User id',
  `created_at` datetime DEFAULT NULL,
  `status` enum('new','on-the-job','pending','done') DEFAULT 'new',
  `addition` text COMMENT 'Additional Information'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `job`
--

INSERT INTO `job` (`id`, `client_id`, `vehicle_id`, `creator_id`, `performer_id`, `created_at`, `status`, `addition`) VALUES
(1, 1, 1, 18, 18, '2016-05-30 19:27:23', 'pending', 'Заклинив двигун'),
(3, 2, 3, 18, 18, '2016-05-30 21:27:58', 'pending', 'Немає компресії,\r\nМасло в двигуні відсутнє,\r\nМожливо потребує капітального ремонту'),
(4, 3, 4, 18, 18, '2016-05-30 21:32:00', 'pending', 'Замовлення запчастин'),
(5, 4, 5, 18, 18, '2016-05-30 22:07:15', 'pending', 'Виготовлення в токарів 2-х напівосів,\r\n'),
(6, 5, 6, 18, 18, '2016-05-30 22:14:04', 'pending', 'Нестабільно працює двигун\r\n(робота по гарантії)'),
(7, 6, 7, 18, 18, '2016-05-30 22:22:56', 'pending', 'Зломаний болт КПП'),
(8, 7, 8, 18, 18, '2016-05-30 22:55:38', 'pending', '(068) 492-21-40 Костянтин\r\nабо (067) 287-48-48\r\nОчікування відповіді від відділу запчастин (i-g)');

-- --------------------------------------------------------

--
-- Структура таблицы `job_log`
--

CREATE TABLE IF NOT EXISTS `job_log` (
  `id` smallint(5) unsigned NOT NULL,
  `job_id` smallint(5) unsigned NOT NULL,
  `info` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1462691083),
('m130524_201442_init', 1462691088);

-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `id` smallint(5) unsigned NOT NULL,
  `brand_id` smallint(5) unsigned NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `model`
--

INSERT INTO `model` (`id`, `brand_id`, `name`) VALUES
(1, 1, 'Gyro Canopy (50cc)'),
(2, 2, 'Sky wave 400'),
(3, 3, 'ZS200GY-2c'),
(4, 4, 'RZR'),
(5, 5, 'ATV 400'),
(6, 3, 'CR (250)'),
(7, 3, 'Active (2008)');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` smallint(5) unsigned NOT NULL,
  `job_id` smallint(5) unsigned NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `job_id`, `name`) VALUES
(1, 1, 'Діагностика двигуна'),
(2, 1, 'Замінити 2 паливних фільтра'),
(3, 1, 'Відремонтувати бензонасос (або замінити його)'),
(4, 1, 'Регулювання карбюратора'),
(5, 1, 'Відрегулювати передні та задні гальма (при необхідності замінити)'),
(6, 1, 'Налаштувати маслонасос'),
(7, 1, 'Відремонтувати спідометр'),
(8, 1, 'Відремонтувати одометр'),
(9, 2, 'Діагностика'),
(10, 3, 'Діагностика'),
(11, 3, 'Капітальний ремонт Двигуна'),
(12, 4, 'Амортизатор задній (Viper ZS200GY-2C)'),
(13, 5, 'Ремонт задньої ходової'),
(14, 5, 'Виготовити проставки задніх амортизаторів'),
(15, 6, 'Діагностика'),
(16, 7, 'Заміна приборної панелі'),
(17, 8, 'Вилка передня (пара)'),
(18, 8, 'Кришка картера (права)'),
(19, 8, 'Фара передня (+пластик передня частина та задня)'),
(20, 8, 'Передня бічна панель Л" / Передня бічна панель П" (ком-кт)'),
(21, 8, 'Клюв'),
(22, 8, 'Дзеркала (пара)'),
(23, 8, 'Педаль гальм задніх'),
(24, 8, 'Левий блок управління (з підсосом)'),
(25, 8, 'Крило переднє');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `full_name`, `photo`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dmitry', 'Козюк Дмитрий', '', '8TQxEuISgYdQ0ezwFl8NPjhIY9uNss0i', '$2y$13$exf6M.Ei7vy.qOpfqZ5GS.HNqP1868X6zVL37pTO9F5SwoHpAI186', NULL, 'fsfkjhskjgh@fskfhshf.ru', 10, 1462691123, 1462691123),
(18, 'Сергей', 'Сегрей Чвирук', '', 'n34x_QV_go2doESCZgCM5jSnqe4KGweC', '$2y$13$nA0ksrVXtIQve/Vv38FSTeC9p1ulVvARYJPOWe/QRNnGhysjYwutK', NULL, '2993@1176.gmail.com', 10, 1464615198, 1464615198),
(19, 'Jenja', 'Шевченоко Є.О.', '', 'VWlYGJGr53btD9WDtiewR171RRdoux-M', '$2y$13$6hFSYB8SQrGoCIWZtYpBPeF2bG/ebtzz7UC13DdhfjODrlVHilKIe', NULL, '2299@584.gmail.com', 10, 1464629858, 1464629858),
(20, 'Niki', 'Слизовський М.О', '', 'fD7zd-HUbSByL4GaR5-3njVQFIDH5D2D', '$2y$13$vEnKCmi3HKrdGzvi4IeMkezXnC3.ICCoVJyWYFQXgOX7/alh0mqbm', NULL, '2126@1240.gmail.com', 10, 1464629978, 1464629978),
(21, 'Alexandr', 'Бондар О.О.', '', 'qD2TIyw4w046FSs_kZDv51-joAp-5QIr', '$2y$13$g1Yd1GSFKHAuvFobs3n9NOtf.HZKnd/lK2Xqj3J2WYzx30XQKt7vW', NULL, '404@2129.gmail.com', 10, 1464630073, 1464630073),
(22, 'Andrey', 'Бжезовський А.П.', '', 'CEaKUI5Ny1RnnUBsl4SeNwyhRSmh9IQ7', '$2y$13$lRnGGR5yoexWc00qyn8m7uqY9SAi02JWoa.r/S0DJGvJ7wc0UgASu', NULL, '2487@1754.gmail.com', 10, 1464630211, 1464630211),
(23, 'Anatoliy', 'Кулик Анатолій Ярославович', '', 'dvRCig2VCH-dPfTvnEGXn5kUImluZgDM', '$2y$13$wUWVemjPPsOG0o7rL8ck4O/QBy1rwpCztQFu06/YbXVUjhrAi3LB2', NULL, '1488@4633.gmail.com', 10, 1464630284, 1464630284);

-- --------------------------------------------------------

--
-- Структура таблицы `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` smallint(5) unsigned NOT NULL,
  `model_id` smallint(5) unsigned NOT NULL,
  `frame_number` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vehicle`
--

INSERT INTO `vehicle` (`id`, `model_id`, `frame_number`) VALUES
(1, 1, 'xxx'),
(2, 2, '---'),
(3, 2, '----'),
(4, 3, '***'),
(5, 4, '///'),
(6, 5, '+++'),
(7, 6, '==='),
(8, 7, '/*-');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `job_log`
--
ALTER TABLE `job_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `job`
--
ALTER TABLE `job`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `job_log`
--
ALTER TABLE `job_log`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `model`
--
ALTER TABLE `model`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
