-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 07:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybasket`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CID` int(11) NOT NULL,
  `CNAME` varchar(25) NOT NULL,
  `CDESCRIPTION` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CID`, `CNAME`, `CDESCRIPTION`) VALUES
(28, 'Electronics', 'Electronics Gadgets'),
(29, 'Clothing', 'Dress items'),
(30, 'Vegetables', 'Vegetables'),
(31, 'category 1', 'trial 1'),
(32, 'category 1', 'trial 1'),
(33, 'category 1', 'cat1'),
(34, 'category 1', 'cat1'),
(35, 'p3', 'fwfew'),
(36, 'c4', 'dqd'),
(37, 'c4', 'dqd'),
(38, 'cqc', 'dqwd'),
(39, 'category-z', 'category through final interface');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUSTID` int(11) NOT NULL,
  `CUSTNAME` varchar(25) NOT NULL,
  `CUSTEMAIL` varchar(50) NOT NULL,
  `CUSTPHONE` int(11) NOT NULL,
  `CUSTPASS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUSTID`, `CUSTNAME`, `CUSTEMAIL`, `CUSTPHONE`, `CUSTPASS`) VALUES
(1, 'devanshu', 'dEmail', 111111, ''),
(3, 'devanshu', 'dEmail2', 111111, '123456'),
(5, 'devanshu', 'dEmail3', 111111, '123456'),
(7, 'devanshu', 'dEmail4', 111111, '123456'),
(8, 'devanshu', 'dEmail5', 111111, '123456'),
(9, 'devanshu', 'dEmail6', 111111, ''),
(10, 'devanshu', 'dEmail7', 111111, ''),
(11, 'devanshu', 'dEmail8', 324, 'cwwewfw'),
(12, 'customer-z', 'email-z', 111111, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `custid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sub_ordid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `custid`, `pid`, `quantity`, `price`, `sub_ordid`) VALUES
(1000, 15, 25, 10, 1999, 2),
(1111, 13, 8, 2, 2001, 1),
(1111, 13, 9, 2, 900, 2),
(1111, 13, 10, 10, 2000, 3),
(1111, 13, 23, 10, 1999, 20),
(1112, 1, 3, 3, 12000, 0),
(1113, 11, 6, 1, 27000, 0),
(1114, 11, 3, 1, 4000, 0),
(1115, 11, 3, 2, 8000, 1),
(1116, 11, 3, 1, 4000, 1),
(1116, 11, 6, 2, 54000, 2),
(1117, 12, 17, 5, 5000, 1),
(1117, 12, 12, 6, 6000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PID` int(11) NOT NULL,
  `PNAME` varchar(25) NOT NULL,
  `PPRICE` int(11) NOT NULL,
  `CID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PID`, `PNAME`, `PPRICE`, `CID`) VALUES
(3, 'T-Shirt', 4000, 'C1'),
(6, 'Vivo V3 Pro', 27000, 'C2'),
(7, 'Shirt', 2000, 'C1'),
(8, 'Shirt', 2000, 'C1'),
(9, 'Pant', 1000, 'C1'),
(10, 'Redmi 5A', 10000, '28'),
(11, 'Redmi 5A', 10000, '28'),
(12, 'Shirt', 1000, '29'),
(13, 'Pixel 7', 50000, '28'),
(14, 'Onion', 50, '30'),
(15, 'qcxwq', 12, '31'),
(16, 'cwqce', 12, '29'),
(17, 'product-z', 1000, '39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSTID`),
  ADD UNIQUE KEY `CUSTEMAIL` (`CUSTEMAIL`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`,`sub_ordid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUSTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
