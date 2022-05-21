-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2013 at 11:57 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jamal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat1`
--

CREATE TABLE IF NOT EXISTS `cat1` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cat1`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'printers'),
(3, 'tablets'),
(10, 'mobiles');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text NOT NULL,
  `categoryid` int(5) NOT NULL,
  `subcategoryid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `details`, `categoryid`, `subcategoryid`) VALUES
(1, 'QMobile E750', '5100.00', 'QMobile E750 with Touch Screen, FM Radio , 2GB Memory Card ', 1, 1),
(2, 'Nokia Lumia', '19100.00', 'Nokia Lumia with high defination camera result with touch screen, 2GB Memory Card and other Features', 1, 2),
(3, 'Dell 965 pentium 4', '12100.00', 'Dell 965 Pentium 4 complete machine with hole sale price \r\n80Gb Hardisk \r\n3.0 Ghz processor \r\n2GB Ram\r\nTower Cassing ', 2, 3),
(4, 'Hp Dual Core ', '15100.00', 'Hp Dual Core 3.3 Ghz processor , 200Gb hardisk, 2GB Ram ', 2, 4),
(5, 'Canon Laserjet 500', '8100.00', 'Canon laserjet 500 , once refill will be depend on 3000 printed papers with high speed with 1 year local waranty ', 3, 5),
(6, 'Hp laserJet 1010', '10100.00', 'New hp Laserjet 1010 with 1 year local warranty (Auto Install).', 3, 6),
(7, 'Hp Core i3', '46100.00', 'Hp Core i3 2.2 Ghz Extreme processor , 500GB Hardisk , 2GB Ram ', 4, 7),
(8, 'Dell Core i5', '70100.00', 'Dell Core i5 2.0Ghz processor, 500GB hardisk , 4GB Ram ', 7, 8),
(10, 'Nokia Lumia', '50000.00', 'New Nokia Lumia Mobile with Some new features ', 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `categoryid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `name`, `pic`) VALUES
(11, 10, 'Nokia', ''),
(3, 2, 'Dell Pentium 4', ''),
(4, 2, 'Dual Core', ''),
(5, 3, 'Canon ', ''),
(6, 3, 'Hp ', ''),
(7, 4, 'Hp Core i3 ', ''),
(8, 4, 'Dell Core i5', ''),
(9, 3, 'wse', ''),
(10, 10, 'sking', '35720400.jpg'),
(13, 10, 'hjgjg', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
