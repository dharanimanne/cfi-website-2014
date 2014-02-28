-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2014 at 07:14 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfi-2014`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `from_username` varchar(50) NOT NULL,
  `to_username` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `messageSentTime` datetime NOT NULL,
  `isReceived` tinyint(1) NOT NULL DEFAULT '0',
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  `tags` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_username`, `to_username`, `message`, `messageSentTime`, `isReceived`, `isRead`, `tags`) VALUES
(1, 'robotxtron2010cde@gmail.com', 'robotxtron2010cd@gmail.com', 'asd', '2014-02-28 22:43:25', 0, 0, 'raftor'),
(2, 'robotxtron2010cd@gmail.com', 'robotxtron2010cde@gmail.com', 'qw', '2014-02-25 00:00:00', 0, 0, 'asd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
