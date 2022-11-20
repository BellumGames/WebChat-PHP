-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2021 at 01:58 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `E_mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Firstname`, `Lastname`, `E_mail`, `Password`) VALUES
(1, 'Bellum', 'Games', 'bucur.alexandru.dan@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `messenger`
--

DROP TABLE IF EXISTS `messenger`;
CREATE TABLE IF NOT EXISTS `messenger` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `E_mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Message` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  `Date_Time` datetime(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messenger`
--

INSERT INTO `messenger` (`ID`, `E_mail`, `Message`, `Date_Time`) VALUES
(22, 'mail@test', 'password', '2021-05-21 12:02:29.000000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `E_mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
