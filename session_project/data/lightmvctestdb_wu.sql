-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-04-21 22:00:27
-- 服务器版本： 5.7.17-log
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lightmvctestdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`) VALUES
(1, 'Paul', 'George'),
(2, 'Jill', 'Lewis'),
(3, 'Jack', 'Brown'),
(4, 'Bill', 'Wright'),
(5, 'John', 'Bernstein');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` varchar(32) NOT NULL,
  `order_status` varchar(16) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `order_status`, `amount`, `description`, `customer_id`) VALUES
(1, '1520308800', 'open', 560, 'Coffee Table Books', 4),
(2, '1520222400', 'open', 9800, 'JavaScript Books', 3),
(3, '1520136000', 'complete', 300, 'Web Development Books', 2),
(4, '1520136000', 'invoiced', 500, 'PHP Books', 5),
(5, '1520308800', 'open', 50, 'Newspapers', 3),
(6, '1520308800', 'held', 300, 'Candy', 3),
(7, '1520222400', 'invoiced', 1200, 'Smart Phones', 5);

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'Computer', '100.99', 'Laptop', 'computer_laptop.jpg'),
(2, 'Diskettes', '1.99', '3.5 Diskettes', 'computer_3.5_diskettes.jpg'),
(3, 'LCD Monitor', '150.99', 'Monitor', 'computer_lcd_monitor.png'),
(4, 'HP Computer', '1200.99', 'HP Computer', 'computer_hp.png'),
(5, 'Computer relic', '20000.00', 'Old Compaq Computer', 'computer_original_compaq.jpg'),
(16, 'trump', '99999.00', 'Make America Greate Again !!!', 'trump.jpg'),
(17, 'hillary', '99999.00', 'My mail box doesn\'t have any problem !!!', 'hillary.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `account` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`account`, `password`) VALUES
('admin', '$2y$10$g8aIp.Xyg5LKtegmLQaivOcKOgIXvMuW7ILCHmmIx5yAVdCwfYKhe'),
('jiahong', '$2y$10$oXs/NnmcvI06sjVLGqVMouK/OvI65xlahi5Idvr8vEkpkESlHHDeS'),
('justinbieber', '$2y$10$T/LbIVlXVr7o81szXFUyQ.JHQDCZWyKvbfdeBQYLceTt935d/hbwy'),
('lilpump', '$2y$10$74636sjiPAOXbWjbgA4dK.212cFVmUa7PAgK30zUH6DFChGluuLQm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`account`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
