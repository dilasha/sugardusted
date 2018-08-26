-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2015 at 03:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `77146783`
--

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `prodId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  KEY `prodId` (`prodId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`prodId`, `userId`) VALUES
(21, 20),
(19, 20);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `prodId` int(11) NOT NULL AUTO_INCREMENT,
  `prodName` varchar(255) NOT NULL,
  `prodImg` varchar(255) NOT NULL,
  `prodRate` double NOT NULL,
  `prodCat` varchar(255) NOT NULL,
  PRIMARY KEY (`prodId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodId`, `prodName`, `prodImg`, `prodRate`, `prodCat`) VALUES
(13, 'Irish cream macaron', '986867aca89c256099929d20cbc5c42a.jpg', 55, 'Other'),
(14, 'Apple cider donut', 'appleciderdonut.jpg', 45, 'Donuts'),
(15, 'Apple cranberry custard tart', 'applecranberrycustardtart.jpg', 95, 'Tarts'),
(16, 'Strawberry rhubarb macaron', 'champagnestrawberryrhubarb.jpg', 85, 'Other'),
(17, 'Passion fruit layer cake', 'passionfruitlayer.jpg', 120, 'Cakes'),
(18, 'Double graham smore cupcake', 'doublegrahamsmorecupcake.jpg', 150, 'Cupcakes'),
(19, 'Red velvet cake with frosting', 'redvelvetcake.jpg', 900, 'Cakes'),
(20, 'Pumpkin donut', 'pumpkindonut.jpg', 110, 'Donuts'),
(21, 'Whiskey cake with frosting', 'whiskeycreamcheesefrosting.jpg', 1200, 'Cakes');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `email`, `password`, `role`) VALUES
(18, 'Admin', 'admin@sugardusted.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(20, 'User1', 'user1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
