-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 185.175.46.104:3306
-- Время создания: Май 11 2021 г., 15:50
-- Версия сервера: 8.0.23
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `todo`
--

CREATE TABLE `todo` (
  `todo_id` int NOT NULL,
  `user_id` int NOT NULL,
  `todo_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `todo_datetime` datetime NOT NULL,
  `todo_priority` tinyint(1) NOT NULL,
  `todo_status` tinyint(1) NOT NULL,
  `todo_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `todo`
--

INSERT INTO `todo` (`todo_id`, `user_id`, `todo_name`, `todo_datetime`, `todo_priority`, `todo_status`, `todo_creation`) VALUES
(1, 1, 'Покрасить забор', '2021-05-16 12:00:00', 0, 0, '2021-05-11 04:22:56'),
(2, 1, 'Покормить кота', '2021-05-12 08:00:00', 2, 0, '2021-05-11 04:23:15'),
(3, 1, 'Убрать в шкафу', '2021-05-27 08:00:00', 1, 0, '2021-05-11 04:23:50'),
(4, 1, 'Закрутить лампочку', '2021-05-03 11:00:00', 0, 1, '2021-05-11 04:24:30'),
(11, 1, 'test', '2021-05-03 11:00:00', 0, 1, '2021-05-11 04:39:24'),
(13, 1, 'test', '2089-04-05 12:00:00', 0, 1, '2021-05-11 12:34:15');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_token` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_token_expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `surname`, `firstname`, `secname`, `user_login`, `user_password`, `user_token`, `user_token_expired`) VALUES
(1, 'Тестовый', 'Тест', 'Тестович', 'test_user', 'e10adc3949ba59abbe56e057f20f883e', '153B4B20-F01D-44FD-A7C0-C8AFC4E93554', '2021-05-12 12:47:34');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`todo_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `todo`
--
ALTER TABLE `todo`
  MODIFY `todo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
