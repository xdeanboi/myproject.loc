-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 04 2022 г., 14:37
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`) VALUES
(1, 1, 'Статья о том, как я погулял', 'Шёл я значит по тротуару, как вдруг. Пришлось как-то встать с самого утра. На небе было много туч, увидел это и лёг дальше спать.', '2021-10-06 21:19:28'),
(2, 1, 'Статью получилось изменить ', 'Какой-то новый текст для редакции', '2021-10-06 21:19:28'),
(3, 1, 'Просто проверка', 'This is text for new article', '2021-11-08 15:20:57'),
(6, 4, 'War and Peace', 'It\'s my first book on this website!', '2021-12-08 00:05:34'),
(7, 1, 'New name by Postman', 'New text by Postman', '2022-01-13 22:10:09'),
(8, 1, 'Название статьи 1', 'Текст статьи 1', '2022-03-04 12:46:15'),
(9, 1, 'Название статьи 2', 'Текст статьи 2', '2022-03-04 12:46:15'),
(10, 1, 'Название статьи 3', 'Текст статьи 3', '2022-03-04 12:46:15'),
(11, 1, 'Название статьи 4', 'Текст статьи 4', '2022-03-04 12:46:15'),
(12, 1, 'Название статьи 5', 'Текст статьи 5', '2022-03-04 12:46:15'),
(13, 1, 'Название статьи 6', 'Текст статьи 6', '2022-03-04 12:46:15'),
(14, 1, 'Название статьи 7', 'Текст статьи 7', '2022-03-04 12:46:15'),
(15, 1, 'Название статьи 8', 'Текст статьи 8', '2022-03-04 12:46:15'),
(16, 1, 'Название статьи 9', 'Текст статьи 9', '2022-03-04 12:46:15'),
(17, 1, 'Название статьи 10', 'Текст статьи 10', '2022-03-04 12:46:15'),
(18, 1, 'Название статьи 11', 'Текст статьи 11', '2022-03-04 12:46:15'),
(19, 1, 'Название статьи 12', 'Текст статьи 12', '2022-03-04 12:46:15'),
(20, 1, 'Название статьи 13', 'Текст статьи 13', '2022-03-04 12:46:15'),
(21, 1, 'Название статьи 14', 'Текст статьи 14', '2022-03-04 12:46:15'),
(22, 1, 'Название статьи 15', 'Текст статьи 15', '2022-03-04 12:46:15'),
(23, 1, 'Название статьи 16', 'Текст статьи 16', '2022-03-04 12:46:15'),
(24, 1, 'Название статьи 17', 'Текст статьи 17', '2022-03-04 12:46:15'),
(25, 1, 'Название статьи 18', 'Текст статьи 18', '2022-03-04 12:46:15'),
(26, 1, 'Название статьи 19', 'Текст статьи 19', '2022-03-04 12:46:15'),
(27, 1, 'Название статьи 20', 'Текст статьи 20', '2022-03-04 12:46:15');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `author_id` int(10) NOT NULL,
  `article_id` int(10) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `author_id`, `article_id`, `text`, `created_at`) VALUES
(1, 1, 1, 'Пробный коммент номер 100000', '2021-12-09 00:13:08'),
(2, 2, 1, 'Пробный коммент номер 20000', '2021-12-09 00:13:08'),
(4, 4, 1, 'ещё один новый коммент', '2021-12-10 00:09:53'),
(7, 4, 3, 'Пусть будет коммент', '2021-12-12 01:06:03'),
(8, 2, 2, 'Урааа... буду первым , кто успеет ', '2021-12-12 02:03:52'),
(9, 4, 1, 'Тут був ще один чувак', '2021-12-23 16:16:20'),
(10, 2, 1, 'Новий комент', '2021-12-23 16:19:37');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('admin','user') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(1, 'testAdmin', 'admin@gmail.com', 1, 'admin', 'hash1', 'token1', '2021-10-06 21:07:38'),
(2, 'user', 'user@gmail.com', 1, 'user', '$2y$10$IiX1TL8F/EgDrr3uRJAFKuLFATqXMoHwH2ZDjOx.BsUbdPu6xDhRa', '4626226d9c34f469bc3e4bcb65f44185f5ccd52c5812f1ff2842c6435253215436eebb9e9d3507f9', '2021-10-06 21:07:39'),
(4, 'admin', 'test.project.developer@gmail.com', 1, 'admin', '$2y$10$IiX1TL8F/EgDrr3uRJAFKuLFATqXMoHwH2ZDjOx.BsUbdPu6xDhRa', '0ff9e1bb766aba9edc26144997cffe9cc3af1b86c1a322a251d031f771381ed6e02418f3384ba8cc', '2021-12-06 15:47:20'),
(5, 'Tester', 'tester@gmail.com', 0, 'user', '$2y$10$1RrwVu9h4RprgzVENN34be/Q96eni7uVCHLr/KU1kXmLKdk0DTKVK', '920c010bf08ceead6bb153eca3c510dfb6ea8f3989e73418ca8fc73eb443fe5535cefb45d878fc8e', '2021-12-12 01:42:48'),
(6, 'Maks', 'pisun@mail.com', 0, 'user', '$2y$10$mOvgTPE4xfQi9GH1ks6pO.jEFbkgmESGSugEvpZGY2kaavHuv7yca', '247de3a418969a32fbc2841cb5e4a1137da6fd1cedeb5328a7549874557c988c365cb181cc6d0630', '2021-12-23 16:18:40');

-- --------------------------------------------------------

--
-- Структура таблицы `users_activation_codes`
--

CREATE TABLE `users_activation_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_activation_codes`
--

INSERT INTO `users_activation_codes` (`id`, `user_id`, `code`) VALUES
(1, 5, 'a9151b5f6c02a92b43b5'),
(2, 6, '774ea6896b655d1b2ab2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
