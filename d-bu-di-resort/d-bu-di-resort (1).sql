-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2024 at 04:59 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d-bu-di-resort`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `d_qty` int(11) NOT NULL,
  `d_subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`o_id`, `p_id`, `d_qty`, `d_subtotal`) VALUES
(37, 1, 1, 1099);

-- --------------------------------------------------------

--
-- Table structure for table `order_head`
--

CREATE TABLE `order_head` (
  `o_id` int(11) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `o_total` float NOT NULL DEFAULT 0,
  `o_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'รอชำระเงิน',
  `o_transport_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `o_img_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_head`
--

INSERT INTO `order_head` (`o_id`, `o_date`, `o_total`, `o_status`, `o_transport_no`, `o_img_name`, `mem_id`) VALUES
(37, '2024-07-25 00:59:54', 1099, 'ชําระเงินแล้ว', NULL, '515.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Member`
--

CREATE TABLE `tbl_Member` (
  `mem_id` int(11) NOT NULL,
  `m_group` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ผู้ดูแลระบบ',
  `m_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_pass` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `m_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_addess` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_save` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_Member`
--

INSERT INTO `tbl_Member` (`mem_id`, `m_group`, `m_user`, `m_pass`, `m_name`, `m_email`, `m_tel`, `m_addess`, `data_save`, `is_deleted`) VALUES
(1, 'ผู้ดูแลระบบ', 'admin', '1234', 'admin haa', 'admin@local.com', '0897277766', 'กรุงเทพมหานคร', '2023-11-04 04:38:01', 0),
(2, 'ผู้ใช้งานทั่วไป', 'user', '1234', 'user', 'user@local.com', '029009009', 'bkk', '2023-11-04 09:33:21', 0),
(3, 'ผู้ใช้งานทั่วไป', 'user2', '1234', 'user2', 'user2@mail.com', '0290090099', 'Bangkok', '2023-11-04 09:48:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_detail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_img` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_type_id` int(11) NOT NULL,
  `p_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `p_name`, `p_price`, `p_detail`, `p_img`, `p_type_id`, `p_deleted`) VALUES
(1, 'ห้องมัลดีฟส์ 1', 1099, 'มีทั้งหมด11ห้อง เข้าพักได้2-4คน  พร้อมอาหารเช้า ราคา 1,500บาทต่อคืน', '365.jpg', 1, 0),
(2, 'ห้องวิวหน้าหาด', 1999, 'มีห้องพัก2ห้อง เข้าพักได้ไม่เกิน8คน พร้อมอาหารเช้า4ที ราคา2,500บาท', '898.jpg', 2, 0),
(4, 'ห้องอเมซอล', 1250, 'ราคา 1500 บาทมีทั้งหมด10ห้อง ราคา3,500บาทมี1ห้อง พร้อมอาหารเช้า', '443.webp', 3, 0),
(5, 'ห้องฮาวาย', 1900, 'ราคา1500/1ห้อง 1300/1ห้อง 1000/2ห้อง พร้อมอาหารเช้า', '128.jpg', 5, 0),
(17, 'ห้องปาล์มบีช', 900, 'ข้างล่าง4ห้อง ข้างบน4ห้อง ราคา1800บาท เข้าพักได้4คน พร้อมอาหารเช้า4ชุด', '770.jpg', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_type`
--

CREATE TABLE `tbl_product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_product_type`
--

INSERT INTO `tbl_product_type` (`id`, `name`, `is_deleted`) VALUES
(1, 'มัลดีฟส์  ', 0),
(2, 'วิล่าหน้าหาด', 0),
(3, 'อเมซอล', 0),
(5, 'ฮาวาย', 0),
(6, 'ปาล์มบีช', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_head`
--
ALTER TABLE `order_head`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `tbl_Member`
--
ALTER TABLE `tbl_Member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_head`
--
ALTER TABLE `order_head`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_Member`
--
ALTER TABLE `tbl_Member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
