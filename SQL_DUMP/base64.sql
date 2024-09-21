-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 21, 2024 at 07:55 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `consolidev`
--

-- --------------------------------------------------------

--
-- Table structure for table `base64`
--

DROP TABLE IF EXISTS `base64`;
CREATE TABLE IF NOT EXISTS `base64` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `type` varchar(6) NOT NULL,
  `original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `opposite` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `base64`
--

INSERT INTO `base64` (`TransactionID`, `username`, `type`, `original`, `opposite`) VALUES
(1, 'test', 'encode', 'abcd', 'YWJjZA=='),
(2, 'test', 'decode', 'aGVsbG8=', 'hello'),
(3, 'test', 'encode', 'testing', 'dGVzdGluZw=='),
(4, 'test', 'decode', 'dGVzdGluZyBoZWxsb29vbz8/', 'testing helloooo??');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `base64`
--
ALTER TABLE `base64`
  ADD CONSTRAINT `base64_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
