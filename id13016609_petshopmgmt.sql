-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 08, 2020 at 07:44 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id13016609_petshopmgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `animalid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imagename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`animalid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animalid`, `name`, `imagename`) VALUES
(1, 'Dog', '5e8cc560bfe058.97574227.jpg'),
(6, 'Cat', '5e8cc4e6cbfd77.14635789.jpg'),
(7, 'Fish', '5e8cc57e283591.31535601.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `userid` int(255) NOT NULL,
  `prodid` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  UNIQUE KEY `userid` (`userid`,`prodid`),
  KEY `prod_id_foreign_key_in_cart` (`prodid`),
  KEY `user_id_foreign_key_in_cart` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`userid`, `prodid`, `qty`) VALUES
(7, 6, 1),
(8, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `credentials` (
  `userid` int(255) NOT NULL,
  `emailid` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `emailid` (`emailid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`userid`, `emailid`, `password`) VALUES
(7, 'pramath@gmail.com', 'root'),
(8, 'rushikesh@gmail.com', 'root'),
(10, 'shripad@gmail.com', '123'),
(9, 'umesh@gmail.com', 'umesh123');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

DROP TABLE IF EXISTS `orderlist`;
CREATE TABLE IF NOT EXISTS `orderlist` (
  `orderid` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prodid` int(255) DEFAULT NULL,
  `prod_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prod_company` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(255) NOT NULL,
  `total_amt` int(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'processing',
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`orderid`, `userid`, `user_email`, `prodid`, `prod_name`, `prod_company`, `qty`, `total_amt`, `status`) VALUES
(1, 7, 'pramath@gmail.com', 6, 'Cat Food', 'Whiskas', 10, 2000, 'shipped');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `prodid` int(255) NOT NULL AUTO_INCREMENT,
  `animalid` int(255) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(255) NOT NULL,
  `mrp` int(255) NOT NULL,
  `imagename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`prodid`) USING BTREE,
  KEY `prod_id_foreign_key_in_products` (`animalid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prodid`, `animalid`, `name`, `company`, `qty`, `mrp`, `imagename`) VALUES
(6, 6, 'Cat Food', 'Whiskas', 5, 200, '5e8cc60c500f77.75229657.jpg'),
(9, 1, 'Dog Belt', 'Pedigree', 40, 150, '5e8cc5e3a84af7.52822935.jpg'),
(11, 1, 'Dog food', 'Pedigree', 30, 300, '5e8cc8ad1cfcd1.12931029.jpeg'),
(12, 7, 'Gold Fish Food', 'Fish O Fish', 22, 150, '5e8cc5a28064e9.75570764.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `userid` int(255) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `emailid` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`userid`, `fname`, `lname`, `emailid`) VALUES
(7, 'pramath', 'kelkar', 'pramath@gmail.com'),
(8, 'Rushikesh', 'chavan', 'rushikesh@gmail.com'),
(9, 'umesh', 'malap', 'umesh@gmail.com'),
(10, 'shripad', 'joshi', 'shripad@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `prod_id_foreign_key_in_cart` FOREIGN KEY (`prodid`) REFERENCES `products` (`prodid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_foreign_key_in_cart` FOREIGN KEY (`userid`) REFERENCES `user_details` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user_details` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
