-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2018 at 10:02 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `email`, `name`) VALUES
(1, 'test', 'test', 'test', 'test'),
(3, 'Sqaissi', '$2y$10$Raw8Oodv59vU5TMhb8Svee7DKIy2JQzh2wceuBD/v4oE8HTArJp4y', 'samer.alqaissi@gmail.com', 'Samer Al Qaissi'),
(4, 'mkhalaweh', '$2y$10$eGpvxIjvDuQkIEF6iNLatuqUXYEgcIYmjKZwIH78.owoeYrMooW/O', 'mkhalaweh10@gmail.com', 'Mohamad Halaweh'),
(5, 'hhalaweh', '$2y$10$K1GWTrpXlsOTMCEIeBK8rOcmpuj486fniK4HDlTeQ4BT4cK3toZpW', 'hamzahalaweh@gmail.com', 'hamza'),
(6, 'admin', '$2y$10$rBLgRzHcdbpP4YagpUsNPOGw3NyU6.4EIGv9j29v60GYpPCCgGlJi', 'admin@gmail.com', 'admin'),
(7, 'user', '$2y$10$.NfTrW0anmFRVYcZG5noPeS71H3JUNzLHvedUMZ53.iSEEFfDuKSS', 'user@gmail.com', 'user'),
(8, 'user2', '$2y$10$b2gUnkd1vZEx4rlqBq2I7uDmwSx3LvRWNyNJPDJN4fFzgrvJ5zYVe', 'user2@gmail.com', 'user two');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `account_id` int(11) unsigned NOT NULL,
  `phone` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `street` varchar(256) NOT NULL,
  `building` varchar(2) NOT NULL,
  `floor` varchar(2) NOT NULL,
  `apartment` varchar(2) NOT NULL,
  `notes` varchar(256) DEFAULT NULL,
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`account_id`, `phone`, `city`, `street`, `building`, `floor`, `apartment`, `notes`) VALUES
(6, 'n/a', 'Amman', 'n/a', 'n/', 'n/', 'n/', 'n/a'),
(4, '0799026768', 'Amman', 'Faysal Al-Mubarak', '14', 'GF', '', 'Apartment on the left'),
(3, '0799147997', 'Amman', 'Nabeel Al Maasher', '15', '3', '10', ''),
(7, '+962796487308', 'Amman', 'Deir Ghbar, Street nabeel moa''sher', '15', '3', '10', 'ring da bell 10 times first please');

-- --------------------------------------------------------

--
-- Table structure for table `admin_session`
--

CREATE TABLE IF NOT EXISTS `admin_session` (
  `session` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_session`
--

INSERT INTO `admin_session` (`session`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat_session`
--

CREATE TABLE IF NOT EXISTS `chat_session` (
  `session` int(1) NOT NULL,
  `account_id` int(11) unsigned NOT NULL,
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `account_id` int(11) unsigned NOT NULL,
  `items` varchar(256) NOT NULL,
  `price` varchar(256) NOT NULL,
  `date_added` date NOT NULL,
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`order_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`account_id`, `items`, `price`, `date_added`, `order_id`) VALUES
(6, 'LG G7 ThinQ : 1\n', '504.99', '2018-08-10', 4),
(6, 'Samsung Galaxy Note 8 : 1\n', '704.99', '2018-08-10', 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(16) NOT NULL,
  `details` text NOT NULL,
  `category` varchar(16) NOT NULL,
  `subcategory` varchar(16) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_name` (`product_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `details`, `category`, `subcategory`, `date_added`) VALUES
(20, 'LG G7 ThinQ', '499.99', '     this is a headache     ', 'main', 'lg', '2018-08-04'),
(24, 'Samsung Galaxy S9', '499.99', '  tip top  ', 'main', 'samsung', '2018-08-04'),
(25, 'Apple iPhone X', '769.99', '  fasfasf  ', 'main', 'apple', '2018-08-04'),
(26, 'Samsung Galaxy Note 8', '699.99', ' cheeki breeki again number 2, we want despacito 2 ', 'main', 'samsung', '2018-08-05'),
(27, 'Test', '0.00', '124', 'main', 'apple', '2018-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id_array` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `payment_date` varchar(255) NOT NULL,
  `mc_gross` varchar(255) NOT NULL,
  `address` varchar(512) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `payer_status` varchar(255) NOT NULL,
  `notify_version` varchar(255) NOT NULL,
  `verify_sign` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `mc_currency` varchar(255) NOT NULL,
  `mc_fee` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `txn_id` (`txn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `product_id_array`, `payer_email`, `first_name`, `last_name`, `payment_date`, `mc_gross`, `address`, `payment_currency`, `txn_id`, `receiver_email`, `payment_type`, `payment_status`, `txn_type`, `payer_status`, `notify_version`, `verify_sign`, `payer_id`, `mc_currency`, `mc_fee`) VALUES
(4, 'xyz123', 'buyer@paypalsandbox.com', 'John', 'Smith', 'Fri Aug 10 2018 20:30:30 GMT+0300 (Eastern European Summer Time)', '12.34', '123 any street\nSan Jose\nCA\n95131\nUnited States\nconfirmed', '', '920109506', 'seller@paypalsandbox.com', 'echeck', 'Completed', 'web_accept', 'verified', '2.1', 'undefined', 'TESTBUYERID01', 'USD', '0.44');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `chat_session`
--
ALTER TABLE `chat_session`
  ADD CONSTRAINT `chat_session_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
