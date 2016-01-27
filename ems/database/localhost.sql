-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2016 at 04:00 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emp`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `firstname` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `middlename` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `lastname` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `suffix` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `dob` date NOT NULL,
  `marital` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `employement` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `employer` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `street` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `zip` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `fax` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `ostreet` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `ocity` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `ostate` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `ozip` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `otelephone` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `omobile` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `ofax` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `emailcheck` tinyint(1) NOT NULL,
  `messagecheck` tinyint(1) NOT NULL,
  `phonecheck` tinyint(1) NOT NULL,
  `anycheck` tinyint(1) NOT NULL,
  `more` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `photo` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `activation` tinyint(1) NOT NULL,
  `activation_key` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `uname` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=88 ;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `dob`, `marital`, `employement`, `employer`, `email`, `street`, `city`, `state`, `zip`, `telephone`, `mobile`, `fax`, `ostreet`, `ocity`, `ostate`, `ozip`, `otelephone`, `omobile`, `ofax`, `emailcheck`, `messagecheck`, `phonecheck`, `anycheck`, `more`, `photo`, `activation`, `activation_key`) VALUES
(83, 'neeraj', '6876f31c02ad2082dd2f7c3fb0b90b90', 'Neeraj', 'Kumar', 'Das', 'M.C.A', 1, '1991-08-18', 'Single', 'Student', 'Mindfire Solutions', 'nkdas91@gmail.com', 'CM/12 VSS Nagar', 'Bhubaneswar', 'Odisha', '751007', '8018770024', '8018770024', '', 'IDCO 2000, Mancheswar', 'Bhubaneswar', 'Odisha', '751010', '8018770024', '8018770024', '', 1, 1, 0, 0, '', 'android-5-0-lollipop-material-2400.jpg', 1, 'fe9fc289c3ff0af142b6d3bead98a923'),
(86, 'hewlett', '6876f31c02ad2082dd2f7c3fb0b90b90', 'Bill', '', 'Hewlett', 'M.Tech', 1, '2016-01-15', 'Single', 'Student', 'mindfiresolutions', 'nkdas91@outlook.com', 'cm-12', 'bhubaneswar', 'odisha', '751007', '8888888888', '8888888888', '', '', '', '', '', '', '', '', 0, 0, 0, 0, '', 'userTile.png', 1, '93db85ed909c13838ff95ccfa94cebd9');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
