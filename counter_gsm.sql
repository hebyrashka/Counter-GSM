-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 27 2021 г., 13:36
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
  `summa_check` float NOT NULL,
  `url_check` varchar(255) DEFAULT NULL,
  `whenAdd` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
