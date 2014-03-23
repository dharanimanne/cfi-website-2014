-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2014 at 12:52 AM
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
-- Table structure for table `gantt_tasks`
--

CREATE TABLE IF NOT EXISTS `gantt_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `progress` float NOT NULL,
  `sortorder` double NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL,
  `activity_id` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `gantt_tasks`
--

INSERT INTO `gantt_tasks` (`id`, `text`, `start_date`, `duration`, `progress`, `sortorder`, `parent`, `activity_id`) VALUES
(12, 'Project #2', '2013-04-02 00:00:00', 18, 0.134921, 10, 0, 0),
(13, 'Task #1', '2013-04-02 08:13:42', 10, 0.2, 15, 12, 0),
(14, 'Task #2', '2013-04-04 00:00:00', 4, 0.9, 20, 12, 0),
(15, 'Task #3', '2013-04-05 00:00:00', 3, 0.6, 30, 12, 0),
(16, 'Task #4', '2013-04-01 00:00:00', 3, 0.214286, 40, 12, 0),
(17, 'Task #5', '2013-04-06 00:00:00', 6, 0.5, 50, 12, 0),
(18, 'Task #2.1', '2013-04-05 00:00:00', 5, 0.3, 39.999999994179234, 14, 0),
(19, 'Task #2.2', '2013-04-05 00:00:00', 6, 0.6, 29.999999995343387, 14, 0),
(20, 'Task #2.3', '2013-04-05 00:00:00', 4, 0.512605, 39.99999999534339, 14, 0),
(21, 'Task #2.4', '2013-04-05 00:00:00', 6, 0.7, 39.99999999301508, 14, 0),
(22, 'Task #4.1', '2013-04-05 00:00:00', 7, 1, 10, 16, 0),
(23, 'Task #4.2', '2013-04-05 00:00:00', 5, 1, 20, 16, 0),
(24, 'Task #4.3', '2013-04-05 00:00:00', 5, 0, 30, 16, 0),
(25, 'New task', '2013-04-01 00:00:00', 1, 0.6, 0, 0, 0),
(26, 'New task', '2013-04-01 00:00:00', 1, 0.628571, 0, 25, 0),
(27, 'New task', '2013-04-01 00:00:00', 1, 0.671429, 0, 0, 0),
(28, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),
(29, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 28, 0),
(30, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 2147483647, 0),
(33, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 29, 0),
(39, 'New task', '2013-04-01 00:00:00', 1, 0, 0, 0, 0),
(41, 'New task 101', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),
(42, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),
(43, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),
(44, 'New task', '2013-04-01 00:00:00', 1, 0, 0, 0, 0),
(45, 'New task', '2013-04-01 00:00:00', 1, 0, 0, 0, 0),
(46, 'New task', '2013-04-01 00:00:00', 1, 0, 0, 0, 0),
(47, 'New task', '2013-04-01 00:00:00', 1, 0, 0, 0, 0),
(48, 'New task', '2013-04-01 00:00:00', 1, 0, 0, 0, 0),
(49, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),

(51, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),
(52, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),
(53, 'New task', '1894-03-21 00:00:00', 1, 0, 0, 52, 0),
(54, 'New task', '2014-03-21 00:00:00', 1, 0, 0, 0, 0),
(55, 'proj 1', '2014-03-17 00:00:00', 11, 0.0467532, 0, 0, 0),
(56, 'New task 1', '2014-03-18 00:00:00', 2, 0.221429, 0, 55, 0),
(57, 'New task 2', '2014-03-20 00:00:00', 4, 0.242857, 0, 55, 0),
(58, 'sub task', '2014-03-18 00:00:00', 2, 0.357143, 0, 56, 0),
(59, 'New task', '2014-03-17 00:00:00', 1, 0, 0, 55, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
