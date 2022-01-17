-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 11:57 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gardenia`
--
CREATE DATABASE IF NOT EXISTS `gardenia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gardenia`;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orderID` varchar(50) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `PaymentMethod` varchar(10) NOT NULL,
  `PaymentDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(50) NOT NULL DEFAULT 'To Ship'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderID`, `userID`, `Address`, `PaymentMethod`, `PaymentDate`, `Status`) VALUES
('order_1', '11', 'No 1 Lorong ABC', 'CC', '2022-01-11 09:13:00', 'Received'),
('order_2', '15', '1,Jln Abc', 'COD', '2022-01-07 12:18:03', 'To Receive'),
('order_3', '17', 'Tabuan Jaya', 'COD', '2022-01-13 11:43:01', 'Received'),
('order_4', '21', 'No 3, Jalan C, Taman Lima', 'CC', '2022-01-13 15:59:43', 'Received'),
('order_5', '19', 'Lorong 1, Jalan Bond', 'COD', '2022-01-13 07:09:14', 'To Receive'),
('order_6', '21', 'No 3, Jalan C, Taman Lima', 'COD', '2022-01-14 04:11:02', 'To Receive'),
('order_7', '21', 'No 3, Jalan C, Taman Lima', 'CC', '2022-01-09 06:02:54', 'To Ship'),
('order_8', '11', 'No 3, Jalan C, Taman Lima', 'CC', '2022-01-12 15:29:45', 'To Receive'),
('order_9', '11', 'No 1, Lorong ABC', 'CC', '2022-01-11 17:50:42', 'Received'),
('order_10', '11', 'No 1 Lorong ABC', 'COD', '2022-01-12 18:27:22', 'Cancelled'),
('order_11', '17', 'Tabuan Jaya', 'COD', '2022-01-13 15:56:10', 'Received'),
('order_12', '21', 'No 3, Jalan C, Taman Lima', 'COD', '2022-01-09 07:32:38', 'To Ship'),
('order_13', '17', 'Tabuan Jaya', 'COD', '2022-01-14 05:15:07', 'Cancelled'),
('order_14', '17', 'Tabuan Jaya', 'COD', '2022-01-09 07:52:06', 'To Ship'),
('order_15', '14', 'Tabuan Jaya', 'CC', '2022-01-09 09:45:59', 'To Ship'),
('order_16', '15', '1,Jalan ABC', 'COD', '2022-01-09 09:57:40', 'To Ship'),
('order_17', '21', 'No 3, Jalan C, Taman Lima', 'CC', '2022-01-09 13:05:59', 'To Ship'),
('order_18', '17', 'Tabuan Jaya', 'COD', '2022-01-09 14:56:18', 'To Ship'),
('order_19', '15', '1,Jalan ABC', 'COD', '2022-01-10 03:03:24', 'To Ship'),
('order_20', '17', 'Tabuan Jaya', 'COD', '2022-01-10 14:40:00', 'To Ship'),
('order_21', '19', 'Lorong 1, Jalan Bond', 'COD', '2022-01-12 17:36:15', 'To Ship'),
('order_22', '19', 'Lorong 1, Jalan Bond', 'CC', '2022-01-12 17:44:59', 'To Ship'),
('order_23', '19', 'Lorong 1, Jalan Bond', 'CC', '2022-01-12 17:47:13', 'To Ship'),
('order_24', '19', 'Lorong 1, Jalan Bond', 'CC', '2022-01-12 17:50:55', 'To Ship'),
('order_25', '19', 'Lorong 1, Jalan Bond', 'COD', '2022-01-12 18:11:01', 'To Ship'),
('order_26', '19', '', 'CC', '2022-01-13 19:04:09', 'Cancelled'),
('order_27', '19', '', 'CC', '2022-01-13 19:04:12', 'Cancelled'),
('order_28', '19', '', 'CC', '2022-01-13 19:04:17', 'Cancelled'),
('order_29', '19', 'Lorong 1, Jalan Bond', 'CC', '2022-01-14 06:43:55', 'To Receive'),
('order_30', '19', 'Lorong 1, Jalan Bond', 'CC', '2022-01-12 19:20:46', 'To Ship'),
('order_31', '17', 'Tabuan Jaya', 'COD', '2022-01-13 01:31:53', 'To Ship'),
('order_32', '15', '1,Jalan ABC', 'COD', '2022-01-13 01:57:01', 'To Ship'),
('order_33', '15', '1,Jalan ABC', 'COD', '2022-01-13 02:00:12', 'To Ship'),
('order_34', '19', 'Lorong 1, Jalan Bond', 'COD', '2022-01-13 03:43:23', 'To Ship'),
('order_35', '19', 'Lorong 1, Jalan Bond', 'COD', '2022-01-13 03:45:02', 'To Ship'),
('order_36', '17', 'Tabuan Jaya', 'COD', '2022-01-13 15:20:38', 'To Ship'),
('order_37', '21', 'No 3, Jalan C, Taman Lima', 'CC', '2022-01-13 15:51:53', 'To Ship'),
('order_38', '21', 'No 3, Jalan C, Taman Lima', 'CC', '2022-01-13 15:57:25', 'To Ship'),
('order_39', '21', 'No 111, Jalan Larut', 'CC', '2022-01-17 08:58:28', 'To Ship');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `Sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Price`, `Stock`, `image`, `Sales`) VALUES
(1, 'Original Classic 400g', 2.8, 40, 'classic400g.png', 18),
(2, 'Original Classic Jumbo 600g', 4, 35, 'classic600g.png', 18),
(3, 'Wholemeal Bread 400g', 3.6, 30, 'wholemeal400g.png', 7),
(10, 'Toast’em Pandan Coconut', 5, 30, 'pandancoconut.png', 6),
(17, 'Delicia Butterscotch 360g', 5, 30, 'butterscotch360g.png', 13),
(18, 'Twiggies Choc-A-Lot', 1.8, 27, 'twiggiesChoc76g.png', 20),
(19, 'QuickBites Chocolate Cream Roll', 1, 30, 'quickbitesChoco.png', 13),
(21, 'QuickBites Butter Sugar Cream Roll', 1, 30, 'ButterSugar.png', 8),
(26, 'Adzuki Red Bean', 3.7, 25, 'hhBLdkI35NE8QIqHxDtF.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Total` float NOT NULL,
  `TransactionDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PaymentMethod` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionID`, `OrderID`, `Total`, `TransactionDate`, `PaymentMethod`) VALUES
(1, 1, 27.2, '2022-01-06 16:07:20', 'CC'),
(2, 2, 5, '2022-01-06 17:52:57', 'COD'),
(3, 3, 5, '2022-01-07 04:43:24', 'COD'),
(5, 4, 14.8, '2022-01-07 14:33:03', 'CC'),
(6, 5, 4, '2022-01-07 18:40:51', 'COD'),
(7, 6, 5.6, '2022-01-09 05:57:51', 'COD'),
(8, 7, 10.4, '2022-01-09 06:02:54', 'CC'),
(9, 8, 16.2, '2022-01-09 06:06:56', 'CC'),
(10, 9, 13.2, '2022-01-09 06:08:48', 'CC'),
(11, 10, 7.8, '2022-01-09 06:10:49', 'COD'),
(12, 11, 3, '2022-01-09 07:22:16', 'COD'),
(13, 12, 10.4, '2022-01-09 07:32:38', 'COD'),
(14, 13, 6.8, '2022-01-09 07:48:44', 'COD'),
(15, 14, 6, '2022-01-09 07:52:06', 'COD'),
(16, 15, 2, '2022-01-09 09:45:59', 'CC'),
(17, 16, 13.6, '2022-01-09 09:57:40', 'COD'),
(18, 17, 5.8, '2022-01-09 13:05:59', 'CC'),
(19, 18, 5.8, '2022-01-09 14:56:18', 'COD'),
(20, 19, 5.6, '2022-01-10 03:03:24', 'COD'),
(21, 20, 6.6, '2022-01-10 14:40:00', 'COD'),
(22, 21, 4, '2022-01-12 17:36:16', 'COD'),
(23, 22, 6.8, '2022-01-12 17:44:59', 'CC'),
(24, 23, 6.8, '2022-01-12 17:47:13', 'CC'),
(25, 24, 2.8, '2022-01-12 17:50:55', 'CC'),
(26, 25, 3.6, '2022-01-12 18:11:01', 'COD'),
(27, 26, 5, '2022-01-12 19:11:56', 'CC'),
(28, 27, 1.8, '2022-01-12 19:13:32', 'CC'),
(29, 28, 1.8, '2022-01-12 19:15:38', 'CC'),
(30, 29, 2.8, '2022-01-12 19:16:59', 'CC'),
(31, 30, 1.8, '2022-01-12 19:20:46', 'CC'),
(32, 31, 9.2, '2022-01-13 01:31:53', 'COD'),
(33, 32, 20, '2022-01-13 01:57:01', 'COD'),
(34, 33, 8, '2022-01-13 02:00:12', 'COD'),
(35, 34, 16.4, '2022-01-13 03:43:23', 'COD'),
(36, 35, 4, '2022-01-13 03:45:02', 'COD'),
(37, 36, 16.6, '2022-01-13 15:20:39', 'COD'),
(38, 37, 6, '2022-01-13 15:51:53', 'CC'),
(39, 38, 2, '2022-01-13 15:57:25', 'CC'),
(40, 39, 5.4, '2022-01-17 08:58:28', 'CC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mobile` varchar(12) NOT NULL,
  `State` varchar(55) NOT NULL,
  `Gender` varchar(55) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `UserType` varchar(55) NOT NULL DEFAULT 'user',
  `pic_path` varchar(100) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `FirstName`, `LastName`, `Email`, `Mobile`, `State`, `Gender`, `Password`, `UserType`, `pic_path`) VALUES
(1, 'Admin', 'A', 'admin@admin.com', '60101234567', 'Sarawak', 'Female', '$2y$10$4AFnQTlsFUaKMxuRuXgQ0e8ShlQVwACfe6KrgYtwVdzolMWwjEYzq', 'admin', 'default.png'),
(11, 'Muhammad', 'Ali', 'alimuhammad@gmail.com', '60198765432', 'Kuala Lumpur', 'Male', '$2y$10$MuZ6W7UFNNGTDN2D9cnPO.R8FHZj3LMGouutGPhzdJLkpl2CBJmcG', 'user', '11.jpg'),
(14, 'Olivia', 'Wong', 'via00@gmail.com', '60198881314', 'Sarawak', 'Female', '$2y$10$plM/0kHAjB.KCfzoIVyZR.HZyUtv1YlXbgByQFZyhGHjuPv5HC8pe', 'user', '14.png'),
(15, 'John', 'Doe', 'maxchia926@gmail.com', '60123456789', 'Pahang', 'Male', '$2y$10$nNisBaASfqGY4gZsaNLPWOirabEi/T0yu5FTa69.YuZtA1/rSKPB6', 'user', '15.jpeg'),
(17, 'Raphael', 'Po', 'poffsdupe00@gmail.com', '60198551990', 'Sarawak', 'Male', '$2y$10$sOTc7qnXIQzdvh2z.mtasOxWbdItAeDsnGGu7NZ3DSOY6d88eKOCC', 'user', '17.png'),
(19, 'James', 'Bond', 'jamesbond@gmail.com', '60266699976', 'Johor', 'Male', '$2y$10$plM/0kHAjB.KCfzoIVyZR.HZyUtv1YlXbgByQFZyhGHjuPv5HC8pe', 'user', 'default.png'),
(20, 'Jeremi Kek', 'Fong', '75162@siswa.unimas.my', '60122222222', 'Johor', 'Male', '$2y$10$K5oe8tuebPOYoLL1muCxzuJZQdOPrTgZR9gm7ZKzTX4miopmoSERy', 'user', 'default.png'),
(21, 'Chuah', 'Wen Juin', '74487@siswa.unimas.my', '60105510010', 'Perak', 'Male', '$2y$10$VCjIFus.RneKnQxTSzxvheAjEtup22nCJa0C2tPCQ4M4Xlz339/za', 'user', '21.jpg'),
(25, 'Rick', 'Astley', 'rickroll@gmail.com', '601234567890', 'Sabah', 'Male', '$2y$10$O8eph/uLxWA0wWUPlQHGKOAJ0IFXTcSbongV8wfy0ASfMhRdw80u2', 'user', '25.jpg'),
(31, 'Hazel', 'Ng', 'hazel96@gmail.com', '601234567890', 'Pulau Pinang', 'Female', '$2y$10$iNf26oYB53aGtxnHEvk3teW/Spxm26nLD5Atx/Utpu9J4eOHwCX5K', 'user', 'default.png'),
(33, 'Michael', 'Jackson', 'heehee@gmail.com', '+60199988800', 'Melaka', 'Male', '$2y$10$LOUg8c19ED3O7ZaotNnFB.I2j4BYMzzjPNd/l9JxiFyscqoQOhfvK', 'user', '33.jpg'),
(40, 'Eric', 'Cartman', 'sp_cartman@outlook.com', '601234567890', 'Kuala Lumpur', 'Male', '$2y$10$oLSw.RP0W6B1dGUTmBkff.sAVhvweoTETf64KwigbZD4ynVJvNu5a', 'user', 'default.png'),
(42, 'Monka', 'Giga', 'monkas@gmail.com', '60222222222', 'Johor', 'Male', '$2y$10$VWWCPfdiXmeG.CP76ZO95.pi.k6vdReBgL29/g/SyGwdmVfmnUlA.', 'user', 'default.png'),
(46, 'Golden', 'Wind', 'requiem@gmail.com', '60222222222', 'Johor', 'Male', '$2y$10$dClwHNMliUua9hvvPVZUFOojhovjU.BUSBeNlEce58M51vTzKkHOu', 'user', 'default.png'),
(49, 'Testing', 'Test', 'test2@gmail.com', '60222222222', 'Johor', 'Male', '$2y$10$yj.WIJQoBP/2S5iJcDTTeeY7b5M85StP9RNAkNTcT859btq0ZmHTC', 'user', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- Database: `gardenia_order`
--
CREATE DATABASE IF NOT EXISTS `gardenia_order` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gardenia_order`;

-- --------------------------------------------------------

--
-- Table structure for table `order_1`
--

CREATE TABLE `order_1` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_1`
--

INSERT INTO `order_1` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(3, 'Wholemeal Bread 400g', 3.6, 2),
(10, 'Toast’em Pandan Coconut', 5, 1),
(17, 'Delicia Butterscotch 360g', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_2`
--

CREATE TABLE `order_2` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_2`
--

INSERT INTO `order_2` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(17, 'Delicia Butterscotch 360g', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_3`
--

CREATE TABLE `order_3` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_3`
--

INSERT INTO `order_3` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(17, 'Delicia Butterscotch 360g', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_4`
--

CREATE TABLE `order_4` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_4`
--

INSERT INTO `order_4` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1),
(2, 'Original Classic Jumbo 600g', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_5`
--

CREATE TABLE `order_5` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_5`
--

INSERT INTO `order_5` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_6`
--

CREATE TABLE `order_6` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_6`
--

INSERT INTO `order_6` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(18, 'Twiggies Choc-A-Lot', 1.8, 2),
(21, 'QuickBites Butter Sugar Cream Roll', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_7`
--

CREATE TABLE `order_7` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_7`
--

INSERT INTO `order_7` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 3),
(19, 'QuickBites Chocolate Cream Roll', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_8`
--

CREATE TABLE `order_8` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_8`
--

INSERT INTO `order_8` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1),
(3, 'Wholemeal Bread 400g', 3.6, 2),
(10, 'Toast’em Pandan Coconut', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_9`
--

CREATE TABLE `order_9` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_9`
--

INSERT INTO `order_9` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(3, 'Wholemeal Bread 400g', 3.6, 2),
(10, 'Toast’em Pandan Coconut', 5, 1),
(19, 'QuickBites Chocolate Cream Roll', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_10`
--

CREATE TABLE `order_10` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_10`
--

INSERT INTO `order_10` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(10, 'Toast’em Pandan Coconut', 5, 1),
(18, 'Twiggies Choc-A-Lot', 1.8, 1),
(19, 'QuickBites Chocolate Cream Roll', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_11`
--

CREATE TABLE `order_11` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_11`
--

INSERT INTO `order_11` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(19, 'QuickBites Chocolate Cream Roll', 1, 2),
(21, 'QuickBites Butter Sugar Cream Roll', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_12`
--

CREATE TABLE `order_12` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_12`
--

INSERT INTO `order_12` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 3),
(19, 'QuickBites Chocolate Cream Roll', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_13`
--

CREATE TABLE `order_13` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_13`
--

INSERT INTO `order_13` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(10, 'Toast’em Pandan Coconut', 5, 1),
(18, 'Twiggies Choc-A-Lot', 1.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_14`
--

CREATE TABLE `order_14` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_14`
--

INSERT INTO `order_14` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1),
(19, 'QuickBites Chocolate Cream Roll', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_15`
--

CREATE TABLE `order_15` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_15`
--

INSERT INTO `order_15` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(21, 'QuickBites Butter Sugar Cream Roll', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_16`
--

CREATE TABLE `order_16` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_16`
--

INSERT INTO `order_16` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 2),
(2, 'Original Classic Jumbo 600g', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_17`
--

CREATE TABLE `order_17` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_17`
--

INSERT INTO `order_17` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1),
(18, 'Twiggies Choc-A-Lot', 1.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_18`
--

CREATE TABLE `order_18` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_18`
--

INSERT INTO `order_18` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1),
(18, 'Twiggies Choc-A-Lot', 1.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_19`
--

CREATE TABLE `order_19` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_19`
--

INSERT INTO `order_19` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_20`
--

CREATE TABLE `order_20` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_20`
--

INSERT INTO `order_20` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1),
(18, 'Twiggies Choc-A-Lot', 1.8, 1),
(21, 'QuickBites Butter Sugar Cream Roll', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_21`
--

CREATE TABLE `order_21` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_21`
--

INSERT INTO `order_21` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_22`
--

CREATE TABLE `order_22` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_22`
--

INSERT INTO `order_22` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1),
(2, 'Original Classic Jumbo 600g', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_23`
--

CREATE TABLE `order_23` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_23`
--

INSERT INTO `order_23` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1),
(2, 'Original Classic Jumbo 600g', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_24`
--

CREATE TABLE `order_24` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_24`
--

INSERT INTO `order_24` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_25`
--

CREATE TABLE `order_25` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_25`
--

INSERT INTO `order_25` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(3, 'Wholemeal Bread 400g', 3.6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_26`
--

CREATE TABLE `order_26` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_26`
--

INSERT INTO `order_26` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(17, 'Delicia Butterscotch 360g', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_27`
--

CREATE TABLE `order_27` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_27`
--

INSERT INTO `order_27` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(18, 'Twiggies Choc-A-Lot', 1.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_28`
--

CREATE TABLE `order_28` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_28`
--

INSERT INTO `order_28` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(18, 'Twiggies Choc-A-Lot', 1.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_29`
--

CREATE TABLE `order_29` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_29`
--

INSERT INTO `order_29` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_30`
--

CREATE TABLE `order_30` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_30`
--

INSERT INTO `order_30` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(18, 'Twiggies Choc-A-Lot', 1.8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_31`
--

CREATE TABLE `order_31` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_31`
--

INSERT INTO `order_31` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1),
(18, 'Twiggies Choc-A-Lot', 1.8, 3),
(21, 'QuickBites Butter Sugar Cream Roll', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_32`
--

CREATE TABLE `order_32` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_32`
--

INSERT INTO `order_32` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(17, 'Delicia Butterscotch 360g', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_33`
--

CREATE TABLE `order_33` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_33`
--

INSERT INTO `order_33` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_34`
--

CREATE TABLE `order_34` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_34`
--

INSERT INTO `order_34` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(1, 'Original Classic 400g', 2.8, 1),
(17, 'Delicia Butterscotch 360g', 5, 2),
(18, 'Twiggies Choc-A-Lot', 1.8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_35`
--

CREATE TABLE `order_35` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_35`
--

INSERT INTO `order_35` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_36`
--

CREATE TABLE `order_36` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_36`
--

INSERT INTO `order_36` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 2),
(17, 'Delicia Butterscotch 360g', 5, 1),
(18, 'Twiggies Choc-A-Lot', 1.8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_37`
--

CREATE TABLE `order_37` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_37`
--

INSERT INTO `order_37` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(10, 'Toast’em Pandan Coconut', 5, 1),
(19, 'QuickBites Chocolate Cream Roll', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_38`
--

CREATE TABLE `order_38` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_38`
--

INSERT INTO `order_38` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(19, 'QuickBites Chocolate Cream Roll', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_39`
--

CREATE TABLE `order_39` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_39`
--

INSERT INTO `order_39` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(18, 'Twiggies Choc-A-Lot', 1.8, 3);
--
-- Database: `gardenia_shoppingcart`
--
CREATE DATABASE IF NOT EXISTS `gardenia_shoppingcart` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gardenia_shoppingcart`;

-- --------------------------------------------------------

--
-- Table structure for table `anonymous_1`
--

CREATE TABLE `anonymous_1` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL,
  `CartTimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_11`
--

CREATE TABLE `user_11` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_14`
--

CREATE TABLE `user_14` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_15`
--

CREATE TABLE `user_15` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_17`
--

CREATE TABLE `user_17` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_19`
--

CREATE TABLE `user_19` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_19`
--

INSERT INTO `user_19` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(2, 'Original Classic Jumbo 600g', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_21`
--

CREATE TABLE `user_21` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_22`
--

CREATE TABLE `user_22` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_25`
--

CREATE TABLE `user_25` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_25`
--

INSERT INTO `user_25` (`ProductID`, `ProductName`, `Price`, `Quantity`) VALUES
(3, 'Wholemeal Bread 400g', 3.6, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
