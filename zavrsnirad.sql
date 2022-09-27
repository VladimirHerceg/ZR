-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2022 at 02:49 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zavrsnirad`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `MemberId` int(15) NOT NULL,
  `PostId` int(20) NOT NULL,
  `Content` longtext NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `MemberId` (`MemberId`),
  KEY `PostId` (`PostId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `MemberId` int(15) NOT NULL,
  `PostId` int(20) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `MemberId` (`MemberId`),
  KEY `PostId` (`PostId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `Id` int(15) NOT NULL AUTO_INCREMENT,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `PTotal` varchar(100) DEFAULT '0',
  `PCurrent` varchar(100) DEFAULT '0',
  `PDeleted` varchar(100) DEFAULT '0',
  `Token` varchar(50) NOT NULL,
  `Moderator` tinyint(4) NOT NULL DEFAULT '0',
  `Admin` tinyint(4) NOT NULL DEFAULT '0',
  `EmailConfirm` tinyint(4) NOT NULL DEFAULT '0',
  `Reports` varchar(10) DEFAULT '0',
  `Banned` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Id`, `Username`, `Password`, `Email`, `Phone`, `PTotal`, `PCurrent`, `PDeleted`, `Token`, `Moderator`, `Admin`, `EmailConfirm`, `Reports`, `Banned`) VALUES
(1, 'Vladimir', 'c756e0151f996188ff216c15566f799d', 'hercegznadlanu@gmail.com', '0637509033', '0', '0', '0', 'eDx9fE0Tin', 1, 1, 1, '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `MemberId` int(15) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Content` longtext NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `MemberId` (`MemberId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `Id` int(15) NOT NULL AUTO_INCREMENT,
  `MemberId` int(15) NOT NULL,
  `PostId` int(20) NOT NULL,
  `Reason` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `MemberId` (`MemberId`),
  KEY `PostId` (`PostId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PostId`) REFERENCES `posts` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`PostId`) REFERENCES `posts` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`PostId`) REFERENCES `posts` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`MemberId`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
