-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 24 2024 г., 15:48
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `s5cheats`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `order_key` varchar(255) DEFAULT NULL,
  `order_amount` decimal(10,2) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price_day` int(11) DEFAULT NULL,
  `price_week` int(11) DEFAULT NULL,
  `price_month` int(11) DEFAULT NULL,
  `manual_url` varchar(255) DEFAULT NULL,
  `loader_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price_day`, `price_week`, `price_month`, `manual_url`, `loader_url`) VALUES
(1, 'dayz bebraware', 300, 600, 2000, 'http://yadi.sk', 'yadi.sk'),
(2, 'ponos', 100, 200, 300, 'http://yadi.sk', 'test.su');

-- --------------------------------------------------------

--
-- Структура таблицы `product_keys`
--

CREATE TABLE `product_keys` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL,
  `product_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `temp_orders`
--

CREATE TABLE `temp_orders` (
  `order_id` int(11) NOT NULL,
  `owner_email` text DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(11) DEFAULT 2,
  `reg_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `balance` decimal(10,2) DEFAULT 0.00,
  `orders` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `group`, `reg_time`, `balance`, `orders`) VALUES
(1, 'test@ponos.ru', '$2y$10$0VQTkkdYeOr/Qimn.bRk/.GyWnSLm7NbnGVPXe3KFGmE3NdsThci.', 2, '2024-07-10 12:45:40', '0.00', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `product_keys`
--
ALTER TABLE `product_keys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `product_keys`
--
ALTER TABLE `product_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
