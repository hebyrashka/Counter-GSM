-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2021 г., 12:02
-- Версия сервера: 8.0.19
-- Версия PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `counter_gsm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `routes`
--

CREATE TABLE `routes` (
  `id` int NOT NULL,
  `from_place` varchar(255) NOT NULL,
  `to_place` varchar(255) NOT NULL,
  `total_km` int NOT NULL,
  `haveId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `routes`
--

INSERT INTO `routes` (`id`, `from_place`, `to_place`, `total_km`, `haveId`) VALUES
(1, 'Асино', 'Копыловка', 100, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `trip`
--

CREATE TABLE `trip` (
  `id` int NOT NULL,
  `dateHappen` date NOT NULL,
  `from_km` int NOT NULL,
  `to_km` int NOT NULL,
  `total_km` int NOT NULL,
  `route` varchar(255) NOT NULL,
  `number_request` varchar(255) NOT NULL,
  `haveId` int NOT NULL,
  `date_check` date NOT NULL,
  `how_litr_check` int NOT NULL,
  `summa_check` int NOT NULL,
  `url_check` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `trip`
--

INSERT INTO `trip` (`id`, `dateHappen`, `from_km`, `to_km`, `total_km`, `route`, `number_request`, `haveId`, `date_check`, `how_litr_check`, `summa_check`, `url_check`) VALUES
(13, '2021-05-29', 100, 200, 100, 'Асино - Копыловка', '123 123', 1, '2021-05-29', 100, 50, NULL),
(14, '2021-06-01', 100, 200, 100, 'Асино - Копыловка', '123 123', 1, '2021-06-03', 100, 50, NULL),
(15, '2021-06-01', 100, 2500, 100, 'Асино - Копыловка', '4242', 1, '2021-06-11', 1000, 500, NULL),
(16, '2021-06-01', 100, 200, 100, 'Асино - Копыловка', '4242', 1, '2021-06-01', 100, 50, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone` bigint DEFAULT NULL,
  `number_license` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `number_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `limit_card` int DEFAULT NULL,
  `norma` varchar(255) DEFAULT NULL,
  `rate_km` float DEFAULT NULL,
  `marka_car` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gov_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type_oil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rasxod_km` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `fio`, `position`, `adress`, `phone`, `number_license`, `number_card`, `limit_card`, `norma`, `rate_km`, `marka_car`, `gov_number`, `type_oil`, `rasxod_km`) VALUES
(1, 'admin', '123', 'Юрьев Александр Михайлович', 'специалиста по чесанию', 'Ул. Пушкина Дом Колотушкина 17', 89521532771, '12313213213', '123', -130, 'summer', 7.75, 'Corona', 'ad141f', 'АИ-92', 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
