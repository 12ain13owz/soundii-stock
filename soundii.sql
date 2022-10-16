-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2022 at 03:15 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soundii`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '1234', 0),
(2, 'user1', '1234', 0),
(3, '1', '1', 1),
(4, '5', '5', 1),
(5, '6', '6', 0),
(10, '7', '555', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_account` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `amount` int(11) NOT NULL,
  `specs` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `read` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `id_product`, `id_account`, `amount`, `specs`, `datetime`, `status`, `read`) VALUES
(11, 82, '0', 5, '', '2022-09-25 17:53:27', 0, 1),
(12, 89, '0', 1, '5', '2022-09-25 17:59:06', 1, 1),
(13, 93, '0', 777, '', '2022-09-25 18:01:55', 0, 1),
(14, 94, '0', 999, '', '2022-09-25 20:11:05', 0, 1),
(15, 95, '0', 123456, '', '2022-09-25 20:11:13', 0, 1),
(16, 95, '0', 9, '9', '2022-09-25 20:12:02', 0, 1),
(17, 95, '0', 1, '1', '2022-09-25 20:12:29', 1, 1),
(18, 95, '0', 9, '', '2022-09-25 20:17:03', 0, 1),
(19, 96, '0', 7, '', '2022-09-25 20:18:22', 0, 1),
(20, 96, '0', 1, '1', '2022-09-26 17:28:04', 0, 1),
(21, 96, '0', 5, '5', '2022-09-26 17:28:14', 0, 1),
(22, 96, '0', 5555, '5', '2022-09-26 17:31:08', 0, 1),
(23, 96, 'admin', 1, '1', '2022-09-26 17:50:21', 1, 1),
(24, 97, 'admin', 5, '', '2022-09-26 17:50:34', 0, 1),
(25, 97, 'user', 1, '1', '2022-09-26 17:50:43', 1, 1),
(26, 97, 'admin', 5, '1', '2022-10-16 17:29:58', 0, 1),
(27, 96, 'admin', 1, '', '2022-10-16 17:32:44', 1, 1),
(28, 98, 'admin', 77777, '', '2022-10-16 18:57:40', 0, 1),
(29, 99, 'admin', 10, '', '2022-10-16 19:59:39', 0, 0),
(30, 99, 'admin', 10, '', '2022-10-16 19:59:48', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `detail` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `stock`, `price`, `detail`, `image_path`, `create_date`) VALUES
(30, '5asd', '21', 59, '1', '1', './img/bg-window.jpg', '2022-09-20 15:40:08'),
(35, '1', '1', 1, '1', '1', '', '2022-09-23 18:29:30'),
(36, '2', '2', 2, '2', '2', '', '2022-09-23 18:29:33'),
(37, '3', '3', 3, '3', '3', '', '2022-09-23 18:29:40'),
(38, '4', '4', 4, '4', '4', '', '2022-09-23 18:29:43'),
(39, '5', '5', 5, '5', '5', '', '2022-09-23 18:29:47'),
(40, '6', '6', 6, '6', '6\r\n', '', '2022-09-23 18:29:50'),
(41, '7', '7', 7, '7', '7', '', '2022-09-23 18:29:53'),
(42, '8', '8', 8, '8', '8', '', '2022-09-23 18:29:56'),
(43, '9', '9', 9, '9', '9', '', '2022-09-23 18:29:59'),
(44, '10', '10', 10, '10', '10', '', '2022-09-23 18:30:03'),
(45, '11', '11', 11, '11', '11', '', '2022-09-23 18:30:07'),
(46, '12', '12', 12, '12', '12', '', '2022-09-23 18:30:11'),
(47, '13', '13', 13, '13', '13', './img/bg-genshin-2.jpg', '2022-09-23 18:30:15'),
(48, '22', '22', 22, '22', '22', '', '2022-09-23 20:33:11'),
(49, '33', '33', 33, '33', '33', '', '2022-09-23 20:33:15'),
(50, '44', '44', 44, '44', '44', '', '2022-09-23 20:33:19'),
(51, '55', '55', 55, '55', '55', '', '2022-09-23 20:33:22'),
(52, '66', '66', 66, '66', '66', '', '2022-09-23 20:33:26'),
(53, '77', '77', 77, '77', '77', '', '2022-09-23 20:33:29'),
(54, '88', '88', 88, '88', '88', '', '2022-09-23 20:33:32'),
(55, '99', '99', 99, '99', '99', '', '2022-09-23 20:33:35'),
(56, '100', '100', 100, '100', '100', '', '2022-09-23 20:33:39'),
(57, '010', '1', 1, '1', '1', '', '2022-09-23 20:33:43'),
(58, '555', '1', 1, '1', '1', '', '2022-09-23 20:33:46'),
(59, '222', '2', 2, '2', '2', '', '2022-09-23 20:33:49'),
(60, '78', '7', 7, '7', '7', '', '2022-09-23 20:33:57'),
(61, '987', '4', 4, '4', '4', '', '2022-09-23 20:34:02'),
(62, '101', '1', 1, '1', '1', '', '2022-09-23 20:34:06'),
(63, '102', '1', 1, '1', '1', '', '2022-09-23 20:34:09'),
(64, '103', '1', 1, '1', '1', '', '2022-09-23 20:34:13'),
(65, '104', '1', 1, '1', '1', '', '2022-09-23 20:34:16'),
(66, '105', '1', 1, '1', '1', '', '2022-09-23 20:34:21'),
(67, '106', '1', 1, '1', '1', '', '2022-09-23 20:34:24'),
(68, '107', '1', 1, '1', '1', '', '2022-09-23 20:34:27'),
(69, '208', '1', 1, '1', '1\r\n', '', '2022-09-23 20:34:31'),
(70, '108', '1', 1, '1', '1', '', '2022-09-23 20:34:34'),
(71, '109', '1', 1, '1', '1', '', '2022-09-23 20:34:37'),
(72, '110', '1', 1, '1', '1', '', '2022-09-23 20:34:40'),
(73, '111', '1', 1, '1', '1', '', '2022-09-23 20:34:43'),
(74, '112', '1', 1, '1', '1', '', '2022-09-23 20:34:46'),
(75, '113', '1', 1, '1', '1', '', '2022-09-23 20:34:49'),
(76, '114', '1', 1, '1', '1\r\n', '', '2022-09-23 20:34:52'),
(77, '115', '1', 1, '1', '1', '', '2022-09-23 20:34:55'),
(78, '116', '1', 1, '1', '1', '', '2022-09-23 20:34:57'),
(79, '117', '1', 1, '1', '1', '', '2022-09-23 20:35:00'),
(80, '118', '1', 1, '1', '1', '', '2022-09-23 20:35:02'),
(81, '1158', '1', 0, '1', '1', '', '2022-09-23 20:35:12'),
(82, '10001', '1', 6, '1', '1dfgdfg', '', '2022-09-25 16:32:45'),
(83, '2515', '1', 1, '1', '\r\n', '', '2022-09-25 17:57:01'),
(85, '888', '8', 8, '8', '8', '', '2022-09-25 17:57:34'),
(87, '1234', '1234', 1234, '1234', '1234', '', '2022-09-25 17:57:51'),
(89, '9999', '1', 0, '1', '1', '', '2022-09-25 17:58:30'),
(91, '5555', '5', 5, '5', '5', '', '2022-09-25 18:01:12'),
(92, '6666', '6', 6, '6', '6', '', '2022-09-25 18:01:30'),
(93, '777', '777', 777, '7778', '777', '', '2022-09-25 18:01:55'),
(94, '999', '999', 999, '999', '9', '', '2022-09-25 20:11:05'),
(95, '12345', '123456', 123473, '1234568', '12345655123', '', '2022-09-25 20:11:13'),
(96, '789', '7', 5566, '7', '7', './img/bg-genshin-2.jpg', '2022-09-25 20:18:22'),
(97, '55555', '555', 9, '5', '5', '', '2022-09-26 17:50:34'),
(99, 'CS19', 'soundbar', 20, '990', '', '', '2022-10-16 19:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `notify` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `notify`) VALUES
(2, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
