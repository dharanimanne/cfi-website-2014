-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2014 at 07:46 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `DocName` varchar(50) NOT NULL,
  `uploadedOn` datetime DEFAULT NULL,
  `uploadedBy` varchar(50) DEFAULT NULL,
  `tags` varchar(50) NOT NULL,
  `activityId` smallint(6) NOT NULL,
  `docLocation` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `DocName`, `uploadedOn`, `uploadedBy`, `tags`, `activityId`, `docLocation`) VALUES
(1, '108b-1394339058.jpg', '2014-03-09 09:54:18', 'vineet.1991.483@gmail.com', '', 2, 'upload/Documents/2/108b-139433'),
(2, '108b-1394339123.jpg', '2014-03-09 09:55:23', 'vineet.1991.483@gmail.com', '', 2, 'upload/Documents/2'),
(3, '108b-1394339258.jpg', '2014-03-09 09:57:38', 'vineet.1991.483@gmail.com', '', 2, 'upload/Documents/2'),
(4, '108b-1394339387.jpg', '2014-03-09 09:59:47', 'vineet.1991.483@gmail.com', '', 2, 'upload/Documents/2'),
(5, '108b-1394339420.jpg', '2014-03-09 10:00:20', 'vineet.1991.483@gmail.com', '', 2, 'upload/Documents/2'),
(6, '108b-1394339560.jpg', '2014-03-09 10:02:40', 'vineet.1991.483@gmail.com', '', 2, 'upload/Documents/2'),
(7, 'IMAG0080.jpg', '2014-03-09 10:03:34', 'vineet.1991.483@gmail.com', '', 2, 'upload/Documents/2'),
(8, 'IMAG0083.jpg', '2014-03-09 10:12:05', 'vineet.1991.483@gmail.com', 'remu kaka', 2, 'upload/Documents/2'),
(10, '1-1394341108.16 ratio end cap velocity', '2014-03-09 10:28:28', 'vineet.1991.483@gmail.com', 'simulation of end cap against different velocities', 1, 'upload/Documents/1'),
(11, '116 ratio end cap velocity-1394341433.jpg', '2014-03-09 10:33:53', 'vineet.1991.483@gmail.com', 'sdsds', 1, 'upload/Documents/1'),
(12, 'end cap with ratio 1.16 (pressure).jpg', '2014-03-09 10:39:50', 'vineet.1991.483@gmail.com', 'simulation', 2, 'upload/Documents/2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
