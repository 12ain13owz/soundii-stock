-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2022 at 01:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `detail` varchar(1000) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `stock`, `price`, `detail`, `image_path`, `create_date`) VALUES
(17, 'A6X', 'A6X ลำโพง Bluetooth 55 วัตต์', 10, '2490', '▪️ระบบปรับ EQ 3 สไตล์ แหลม กลาง เบส\r\n▪️กำลังขับรวม 55 วัตต์ ลำโพงระบบ 2.1\r\n▪️เชื่อม 2 ตัวเพิ่มกำลังขับถึง 110 วัตต์\r\n▪️มีไฟ LED lights\r\n▪️ดอกซัพเบส 4 นิ้ว Deep Power 1 ดอก เสียงเบสลงลึก สร้างมวลเบสมหาศาล \r\n▪️Passive Radiator เพิ่มความนุ่มเสียงเบส\r\n▪️ดอก High Tweeter 2 ดอก ให้เสียงกลางที่ใสเป็นธรรมชาติที่สุด\r\n▪️รองรับ Bluetooth 5.0, USB, AUX และ SD Card\r\n▪️จะต่อทีวีดูหนัง ฟังเพลงโปรด หรือจะต่อเข้าคอมพิวเตอร์ เล่นเกมส์เสียงไม่ดีเลย์\r\n▪️ระยะบลูทูธมากถึง 10 เมตร\r\n▪️ทำจากวัสดุคุณภาพสูง ใช้นาน ทนทาน พร้อมลุย\r\n▪️ แบต 6,000 mAh ฟังเพลงได้ต่อเนื่อง 4-6 ชั่วโมง\r\n▪️เป็น Power Bank ในตัว ชาร์จมือถือได้\r\n▪️กันน้ำได้ระดับ IPX6\r\n▪️ฟังได้ทั้ง Indoor และ Outdoor\r\n▪️ขนาด 400 x 154 x 185 มม.', './img/A6X.jpg', '2022-09-16 18:01:13'),
(18, 'S3', 'ลำโพงบลูทูธ วินเทจ S3', 20, '690', '- กำลังขับรวม 10 วัตต์\r\n- เชื่อม 2 ตัว กำลังขับถึง 20 วัตต์\r\n- เสียงใส นุ่มลึก ฟังสบาย\r\n- ฟังต่อเนื่อง 2-3 ชั่วโมง\r\n- รองรับ Bluethooth, USB, Micor SD Card และ AUX\r\n- ต่อเข้าคอมพิวเตอร์, ทีวีผ่านช่องหูฟัง (AUX)\r\n- ระบบบลูทูธ 5.0\r\n- จับสัญญาณได้ 10 เมตร\r\n- แบต 2400 mAh\r\n- ขนาด 39 x 10 x 10 เซนติเมตร\r\n- น้ำหนัก 800 กรัม', './img/S3.jpg', '2022-09-16 18:01:51'),
(19, 'T5', 'ลำโพงวิบวับ T5', 25, '690', '- กำลังขับรวม 10 วัตต์\r\n- เชื่อม 2 ตัวกำลังขับ 20 วัตต์\r\n- เสียงดี พกพาสะดวก มีไฟวิบวับ\r\n- ฟังต่อเนื่อง 3-4 ชั่วโมง\r\n- รองรับ Bluethooth, USB, Micro SD Card และ AUX\r\n- ต่อเข้าคอมพิวเตอร์, ทีวีผ่านช่องหูฟัง (AUX)\r\n- ระบบบลูทูธ 5.0\r\n- จับสัญญาณได้ 10 เมตร\r\n- แบต 1800 mAh\r\n- ขนาด 22.4 x 7 x 7.2 เซนติเมตร\r\n- น้ำหนัก 590 กรัม', './img/272998100_1097968000772622_2853668421370220996_n.jpg', '2022-09-16 18:14:44'),
(20, '', '', 0, '0', '', '', '2022-09-16 18:30:21'),
(21, '5', '5', 5, '5', '5', './img/272998100_1097968000772622_2853668421370220996_n.jpg', '2022-09-16 18:30:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
