-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 28 2022 г., 23:34
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `f0586911_socoban`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `Time` datetime NOT NULL,
  `Content_ru` text COLLATE utf8_unicode_ci NOT NULL,
  `Content_en` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`ID`, `Time`, `Content_ru`, `Content_en`) VALUES
(1, '2021-10-09 13:12:57', 'Сегодня началась разработка сайта для игры \"Сокобан\".', 'Today, the development of a website for the game \"Sokoban\" has begun.'),
(2, '2021-10-10 03:24:31', 'Идет второй день разработки, а на почту уже приходят десятки вопросов! Обо всём по порядку. 1) На сайте планируется реализовать возможность как создавать, так и решать задачи \"Сокобан\". 2) Данные возможности (как и весь остальной функционал) будет бесплатным. 3) Разработка минимального функционала завершится через 2-3 дня. По всем вопросам обращаться по почте socoban1@yandex.ru', 'The second day of development is underway, and dozens of questions are already coming to the mail! About everything in order. 1) It is planned to implement the ability to both create and solve Sokoban tasks on the site. 2) These features (as well as all other functionality) will be free. 3) The development of the minimum functionality will be completed in 2-3 days. For all questions, please contact by mail socoban1@yandex.ru'),
(3, '2021-10-11 15:50:02', 'ВНИМАНИЕ! Уважаемые посетители, просьба не обращать внимания на эту новость! Она является тестовой. Просьба отнестись с понимаем. Спасибо!', 'Attention! Dear visitors, please do not pay attention to this news! It is a test one. Please treat with understanding. Thanks!'),
(4, '2021-10-16 21:43:47', 'Хорошие новости! Разработка немного затянулась, но все же мы это сделали! Основной функционал сайта готов: теперь вы можете решать задачи, регистрироваться и входить в систему. На этом работа не заканчивается - ждите новых обновлений.', 'Good news! The development was a bit delayed, but we did it anyway! The main functionality of the site is ready: now you can solve tasks, register and log in. This is not the end of the work - wait for new updates.');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `ID` int(11) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `Time` date NOT NULL,
  `Text` text COLLATE utf8_unicode_ci NOT NULL,
  `Mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`ID`, `AuthorID`, `Time`, `Text`, `Mark`) VALUES
(1, -1, '2022-01-28', 'Мой отзыв', 5),
(2, -1, '2022-01-28', 'Мой отзыв', 5),
(3, -1, '2022-01-28', 'Another one review!', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `ID` int(11) NOT NULL,
  `difficulty` int(11) NOT NULL,
  `columnCount` int(11) NOT NULL,
  `rowCount` int(11) NOT NULL,
  `pos` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`ID`, `difficulty`, `columnCount`, `rowCount`, `pos`) VALUES
(1, 2, 7, 5, 'wwwwwwwwpceeewwebecewwgebegwwwwwwww'),
(2, 4, 8, 5, 'wwwwwwwwwpcgeeewwebebgewwebgbegwwwwwwwww'),
(3, 5, 9, 5, 'wwwwwwwwwwpbgeeeewwebbcceewwgbgeeegwwwwwwwwww'),
(4, 3, 6, 6, 'wwwwwwwpegewwgebewwbecewwgebewwwwwww'),
(5, 3, 6, 6, 'wwwwwwwqbggwwgbebwwebeewwgbeewwwwwww'),
(6, 6, 7, 6, 'wwwwwwwwpbegewwcbbeewwegebewwegbggwwwwwwww'),
(7, 5, 7, 6, 'wwwwwwwwqbeeewwebgbgwwgbgbewweeecewwwwwwww'),
(8, 5, 7, 6, 'wwwwwwwweeqegwwcbbbbwwegegewweebegwwwwwwww'),
(9, 6, 7, 6, 'wwwwwwwwpeceewwcbeecwwececewwgeeeewwwwwwww'),
(10, 1, 6, 6, 'wwwwwwwpecewweebewweeeewweeegwwwwwww'),
(11, 1, 6, 6, 'wwwwwwwpceewwebecwweeeewweegewwwwwww'),
(12, 3, 7, 6, 'wwwwwwwwpbeegwwgbwbewwbeweewwgeeegwwwwwwww'),
(13, 3, 7, 6, 'wwwwwwwwqeeegwwbbwbbwweewegwwgebegwwwwwwww'),
(14, 3, 7, 7, 'wwwwwwwwpbgeewwgwbwewweeeeewwewbwgwweeeeewwwwwwww'),
(15, 2, 11, 4, 'wwwwwwwwwwwwpbebegeegwwgbegebebgwwwwwwwwwwww'),
(16, 2, 18, 18, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwweeewwwweeewwwwwwwweewwwwwgwpbeeeeeeeeeewwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwwwwewwwwwwwwwwewwwweeeeeeeeeeeeeeeewwweewwwwwwwwwweeewweeewwwwwwwwwwewewwwwwwwwwwwwwwwwwww'),
(17, 4, 8, 8, 'wwwwwwwwwwwpeewwwebgbbwwweewweewweewweewwwgceeewwwgeewwwwwwwwwww'),
(18, 6, 7, 7, 'wwwwwwwwwqecwwwebebewweecbewwebgegwwwegewwwwwwwww'),
(19, 5, 7, 7, 'wwwwwwwweeegewwebbcgwwgbpbewwecbcgwwgeeeewwwwwwww'),
(20, 1, 5, 3, 'wwwwwwpbgwwwwww'),
(21, 5, 7, 7, 'wwwwwwwwgcebgwwgbebgwwebqbewwececewwgbebgwwwwwwww'),
(22, 6, 7, 7, 'wwwwwwwwwecepwwebeegwwegecewwebebewwwgecwwwwwwwww');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `login` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `solvedTasks` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `login`, `password`, `solvedTasks`) VALUES
(17, 'admin', '77bc9742cfa6f38af85d8496af4200a9', ''),
(18, 'Lesha', '77bc9742cfa6f38af85d8496af4200a9', '10 11 1 15 4 5 12 13 14 2 3 6 8 7 16 9 17 18 19 20 21 22'),
(19, 'Oleg', '77bc9742cfa6f38af85d8496af4200a9', '10 11 1 15 4 5 12 13 14 2 3 7 8 16 6 9 17 20 18 19 21 22'),
(20, 'P2009', 'd6a9a933c8aafc51e55ac0662b6e4d4a', '10 11 1 16 9 20'),
(21, 'Gena', '77bc9742cfa6f38af85d8496af4200a9', '10 11 20 16 1 15'),
(22, 'dassda', 'b447c27a00e3a348881b0030177000cd', '');

-- --------------------------------------------------------

--
-- Структура таблицы `visiting`
--

CREATE TABLE `visiting` (
  `Date` date NOT NULL,
  `index.php` int(11) NOT NULL,
  `play.php` int(11) NOT NULL,
  `task.php` int(11) NOT NULL,
  `registration.php` int(11) NOT NULL,
  `profile.php` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `visiting`
--

INSERT INTO `visiting` (`Date`, `index.php`, `play.php`, `task.php`, `registration.php`, `profile.php`) VALUES
('2021-10-10', 60, 0, 0, 0, 0),
('2021-10-11', 488, 0, 0, 0, 0),
('2021-10-12', 249, 253, 0, 0, 0),
('2021-10-13', 235, 254, 152, 0, 0),
('2021-10-14', 124, 27, 34, 0, 0),
('2021-10-15', 110, 5, 5, 3, 0),
('2021-10-16', 389, 13, 19, 126, 0),
('2021-10-17', 30, 12, 10, 6, 54),
('2021-10-18', 132, 3, 6, 12, 18),
('2021-10-19', 59, 23, 33, 9, 4),
('2021-10-20', 104, 83, 140, 4, 6),
('2021-10-21', 41, 15, 33, 3, 3),
('2021-10-22', 92, 103, 279, 12, 24),
('2021-10-23', 287, 56, 211, 39, 69),
('2021-10-24', 82, 28, 208, 16, 46),
('2021-10-25', 51, 8, 67, 14, 34),
('2021-10-26', 70, 3, 10, 5, 29),
('2021-10-27', 41, 4, 9, 7, 30),
('2021-10-28', 40, 1, 14, 3, 27),
('2021-10-29', 27, 1, 10, 0, 25),
('2021-10-30', 150, 10, 20, 20, 34),
('2021-10-31', 47, 6, 52, 2, 29),
('2021-11-01', 36, 6, 27, 3, 26),
('2021-11-02', 30, 20, 37, 4, 2),
('2021-11-03', 139, 38, 8, 10, 5),
('2021-11-04', 33, 12, 35, 9, 8),
('2021-11-05', 6, 0, 1, 0, 0),
('2021-11-06', 6, 1, 0, 0, 0),
('2021-11-07', 18, 4, 5, 11, 1),
('2021-11-08', 7, 2, 0, 1, 0),
('2021-11-09', 6, 0, 4, 0, 0),
('2021-11-10', 7, 1, 3, 0, 0),
('2021-11-11', 4, 1, 3, 0, 0),
('2021-11-12', 47, 7, 2, 5, 2),
('2021-11-13', 16, 3, 1, 5, 0),
('2021-11-14', 14, 2, 1, 3, 0),
('2021-11-15', 4, 1, 1, 0, 2),
('2021-11-16', 4, 1, 0, 1, 1),
('2021-11-17', 15, 0, 0, 2, 1),
('2021-11-18', 4, 0, 3, 0, 1),
('2021-11-19', 47, 1, 1, 13, 13),
('2021-11-20', 5, 0, 2, 1, 1),
('2021-11-21', 6, 1, 4, 0, 1),
('2021-11-22', 5, 0, 5, 0, 2),
('2021-11-23', 11, 0, 1, 0, 1),
('2021-11-24', 2, 1, 0, 0, 0),
('2021-11-25', 6, 1, 1, 0, 1),
('2021-11-26', 6, 0, 0, 0, 1),
('2021-11-27', 5, 0, 0, 0, 1),
('2021-11-28', 26, 0, 1, 3, 3),
('2021-11-29', 2, 0, 0, 0, 1),
('2021-11-30', 7, 0, 0, 0, 1),
('2021-12-01', 2, 1, 0, 0, 1),
('2021-12-02', 5, 0, 1, 0, 1),
('2021-12-03', 6, 0, 0, 1, 0),
('2021-12-04', 127, 7, 16, 3, 3),
('2021-12-05', 27, 2, 2, 0, 0),
('2021-12-06', 2, 0, 0, 0, 1),
('2021-12-07', 3, 0, 0, 0, 0),
('2021-12-08', 3, 0, 1, 0, 1),
('2021-12-09', 3, 0, 0, 0, 0),
('2021-12-10', 3, 1, 0, 0, 0),
('2021-12-11', 2, 0, 1, 0, 1),
('2021-12-12', 3, 1, 1, 0, 0),
('2021-12-13', 2, 0, 0, 0, 0),
('2021-12-14', 3, 1, 1, 0, 1),
('2021-12-15', 2, 0, 0, 0, 0),
('2021-12-16', 3, 0, 0, 0, 0),
('2021-12-17', 4, 1, 1, 2, 1),
('2021-12-18', 2, 0, 0, 0, 0),
('2021-12-19', 3, 1, 1, 0, 1),
('2021-12-20', 3, 1, 1, 0, 1),
('2021-12-21', 5, 0, 1, 0, 0),
('2021-12-22', 3, 1, 1, 0, 1),
('2021-12-23', 4, 1, 1, 0, 0),
('2021-12-24', 1, 0, 0, 0, 0),
('2021-12-25', 4, 2, 2, 0, 0),
('2021-12-26', 1, 0, 0, 0, 1),
('2021-12-27', 4, 1, 1, 0, 0),
('2021-12-28', 1, 0, 0, 0, 0),
('2021-12-29', 4, 1, 0, 0, 0),
('2021-12-30', 3, 1, 1, 1, 0),
('2021-12-31', 2, 0, 0, 0, 1),
('2022-01-01', 3, 0, 0, 0, 0),
('2022-01-02', 5, 0, 6, 2, 5),
('2022-01-03', 1, 0, 0, 0, 0),
('2022-01-04', 2, 1, 1, 0, 0),
('2022-01-05', 13, 1, 4, 2, 1),
('2022-01-06', 7, 1, 1, 0, 0),
('2022-01-07', 3, 0, 1, 0, 0),
('2022-01-08', 6, 1, 2, 11, 2),
('2022-01-09', 5, 1, 26, 1, 8),
('2022-01-10', 4, 0, 2, 0, 1),
('2022-01-11', 1, 1, 1, 0, 0),
('2022-01-12', 2, 0, 1, 0, 0),
('2022-01-13', 1, 0, 1, 0, 1),
('2022-01-14', 4, 1, 2, 0, 0),
('2022-01-15', 1, 0, 0, 0, 0),
('2022-01-16', 3, 1, 2, 0, 1),
('2022-01-17', 0, 1, 0, 0, 0),
('2022-01-18', 4, 1, 1, 0, 1),
('2022-01-19', 2, 0, 0, 0, 0),
('2022-01-20', 1, 0, 1, 0, 1),
('2022-01-21', 2, 1, 0, 0, 1),
('2022-01-22', 4, 1, 1, 0, 0),
('2022-01-23', 2, 1, 1, 0, 1),
('2022-01-24', 3, 1, 0, 0, 0),
('2022-01-25', 2, 0, 0, 0, 0),
('2022-01-26', 2, 1, 1, 0, 1),
('2022-01-27', 110, 22, 7, 33, 32),
('2022-01-28', 1, 15, 0, 2, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `visiting`
--
ALTER TABLE `visiting`
  ADD PRIMARY KEY (`Date`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
