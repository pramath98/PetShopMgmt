-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 30, 2020 at 02:47 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animalid`, `name`, `imagename`) VALUES
(1, 'Dog', 'dog.jpg'),
(6, 'Citten', 'cat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `userid` int(255) NOT NULL,
  `prodid` int(255) NOT NULL,
  KEY `userid` (`userid`) USING BTREE,
  KEY `prodid` (`prodid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `credentials` (
  `userid` int(255) NOT NULL,
  `emailid` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`userid`, `emailid`, `password`) VALUES
(7, 'pramath@gmail.com', 'root'),
(8, 'rushi@gmail.com', 'root'),
(9, 'umesh@gmail.com', 'umesh123'),
(10, 'shripad@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

DROP TABLE IF EXISTS `orderlist`;
CREATE TABLE IF NOT EXISTS `orderlist` (
  `orderid` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prodid` int(255) DEFAULT NULL,
  `prod_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prod_company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`orderid`),
  KEY `userid` (`userid`) USING BTREE,
  KEY `prodid` (`prodid`) USING BTREE,
  KEY `prod_name_foreign_key_in_orderlist` (`prod_name`),
  KEY `prod_comp_foreign_key_in_orderlist` (`prod_company`),
  KEY `user_email_id_foreign_key_in_orderlist` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`orderid`, `userid`, `user_email`, `prodid`, `prod_name`, `prod_company`, `qty`, `status`) VALUES
(1, 7, 'pramath@gmail.com', 1, 'Dog Food', 'Pedigree', 5, 'processing'),
(2, 8, 'rushikesh@gmail.com', 6, 'Cat foody', 'Whiskas', 15, 'processing');

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
  KEY `prod_id_foreign_key_in_products` (`animalid`),
  KEY `name` (`name`),
  KEY `company` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prodid`, `animalid`, `name`, `company`, `qty`, `mrp`, `imagename`) VALUES
(1, 1, 'Dog Food', 'Pedigree', 50, 500, 'pedigree_dog_food.jpeg'),
(6, 1, 'Cat foody', 'Whiskas', 40, 200, 'whiskas_cat_food.jpg'),
(7, 1, 'Dog Belt', 'Pedigree', 40, 200, 'dog_belt.jpg');

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
  PRIMARY KEY (`userid`),
  KEY `emailid` (`emailid`)
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
  ADD CONSTRAINT `prodid` FOREIGN KEY (`prodid`) REFERENCES `products` (`prodid`);

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user_details` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `prod_comp_foreign_key_in_orderlist` FOREIGN KEY (`prod_company`) REFERENCES `products` (`company`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_id_foreign_key_in_orderlist` FOREIGN KEY (`prodid`) REFERENCES `products` (`prodid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_name_foreign_key_in_orderlist` FOREIGN KEY (`prod_name`) REFERENCES `products` (`name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_email_id_foreign_key_in_orderlist` FOREIGN KEY (`user_email`) REFERENCES `user_details` (`emailid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_foreign_key_in_orderlist` FOREIGN KEY (`userid`) REFERENCES `user_details` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `prod_id_foreign_key_in_products` FOREIGN KEY (`animalid`) REFERENCES `animals` (`animalid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
