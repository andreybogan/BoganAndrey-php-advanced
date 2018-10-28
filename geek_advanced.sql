-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 21 2018 г., 01:54
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geek_advanced`
--
CREATE DATABASE IF NOT EXISTS `geek_advanced` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `geek_advanced`;

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `id_prod` tinyint(3) UNSIGNED NOT NULL,
  `id_user` tinyint(3) UNSIGNED NOT NULL,
  `amount` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` tinyint(3) UNSIGNED NOT NULL,
  `id_user` tinyint(3) UNSIGNED NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('new','processing','delivered','cancelled') NOT NULL DEFAULT 'new',
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `date`, `address`, `status`, `total`) VALUES
(1, 7, 1538886603, 'Самара', 'cancelled', 12100);

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id_order` tinyint(3) UNSIGNED NOT NULL,
  `id_prod` tinyint(3) UNSIGNED NOT NULL,
  `item_price` int(11) NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id_order`, `id_prod`, `item_price`, `quantity`, `name`) VALUES
(1, 1, 1500, 1, 'Портмоне для документов'),
(1, 2, 750, 8, 'Коробочка для денег'),
(1, 3, 2300, 2, 'Органайзер для детских документов');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `text` text NOT NULL,
  `price` smallint(6) NOT NULL,
  `img` varchar(64) DEFAULT NULL,
  `hide` enum('see','hide') NOT NULL DEFAULT 'see'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO products (`id`, `name`, text, `price`, `img`, `hide`) VALUES
(1, 'Портмоне для документов', 'Отличный портмоне для мужчин. Стильный и практичный. Подойдёт для каждодневного использования. Имеет скрытые магнитные застежки.', 1500, '1-1.jpg', 'see'),
(2, 'Коробочка для денег', 'Коробочка для денежного подарка \"Travel\" с открыткой.\r\nОтличная упаковка для денежного подарка!\r\nВас пригласили на свадьбу, день рождения, юбилей, и вы хотите красиво подарить денежные средства, на долгожданное путешествие.\r\nДанная коробочка отличная и оригинальная упаковка для вашего подарка!', 750, '2-1.jpg', 'see'),
(3, 'Органайзер для детских документов', 'Надоело искать документы по всему дому? Носите их в файлике с кнопочкой? В нужный момент перебираете кучу, чтобы найти свидетельство? Забудьте все эти проблемы! В этом органайзере все по местам.', 2000, '3-1.jpg', 'see'),
(4, 'Удивительные фотографии птиц', 'Это одни из самых удивительных фотографий известного во всем мире фотографа Неизвестного Ивана.', 500, '8ca12b96d_00000013-2.jpg', 'see');

-- --------------------------------------------------------

--
-- Структура таблицы `product_img`
--

CREATE TABLE `product_img` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `id_prod` tinyint(3) UNSIGNED NOT NULL,
  `img` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_img`
--

INSERT INTO `product_img` (`id`, `id_prod`, `img`) VALUES
(1, 1, '1-1.jpg'),
(2, 1, '1-2.jpg'),
(3, 2, '2-1.jpg'),
(4, 2, '2-2.jpg'),
(5, 2, '2-3.jpg'),
(6, 3, '3-1.jpg'),
(7, 3, '3-2.jpg'),
(8, 3, '3-3.jpg'),
(9, 3, '3-4.jpg'),
(15, 4, '8ca12b96d_00000013-2.jpg'),
(16, 4, '8ca12b96d_00000028.jpg'),
(17, 4, '8ca12b96d_00000035.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(4) UNSIGNED NOT NULL,
  `login` varchar(32) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO users (id, `login`, `pass`, `name`) VALUES
(7, 'andrey', '$2y$10$XotKDX3afbJu2HKbRv7j/.RcafaLb8RbqOLo9W9uEyYzWcbcMVIAy', 'Андрей'),
(8, 'olgabogan', '$2y$10$Z2aUDimNIUjELgtbQ0Dfde.sQ.auRKQhAISAUihDwpzQpQUE/IfCe', 'Ольга');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`) USING BTREE,
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_prod`,`id_order`);

--
-- Индексы таблицы `products`
--
ALTER TABLE products
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Индексы таблицы `user`
--
ALTER TABLE users
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE products
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE users
  MODIFY id tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `product_img`
--
ALTER TABLE `product_img`
  ADD CONSTRAINT `product_img_products_id_fk` FOREIGN KEY (`id_prod`) REFERENCES products (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
