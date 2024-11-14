-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2024 at 12:49 AM
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
-- Table structure for table `api_requests`
--

DROP TABLE IF EXISTS `api_requests`;
CREATE TABLE IF NOT EXISTS `api_requests` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `url` varchar(100) NOT NULL,
  `method` enum('GET','POST','PUT','DELETE') NOT NULL,
  `data` text,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base64`
--

DROP TABLE IF EXISTS `base64`;
CREATE TABLE IF NOT EXISTS `base64` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(6) NOT NULL,
  `original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `opposite` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `base64`
--

INSERT INTO `base64` (`TransactionID`, `username`, `date`, `type`, `original`, `opposite`) VALUES
(1, 'weeyee', '2024-11-13', 'encode', 'wee', 'd2Vl');

-- --------------------------------------------------------

--
-- Table structure for table `caseconverter`
--

DROP TABLE IF EXISTS `caseconverter`;
CREATE TABLE IF NOT EXISTS `caseconverter` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `differencechecker`
--

DROP TABLE IF EXISTS `differencechecker`;
CREATE TABLE IF NOT EXISTS `differencechecker` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `differencesFound` int DEFAULT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `duplicateremover`
--

DROP TABLE IF EXISTS `duplicateremover`;
CREATE TABLE IF NOT EXISTS `duplicateremover` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `tool_ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `isFavorite` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tool_ID`),
  KEY `username` (`username`),
  KEY `tool_ID` (`tool_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hashing`
--

DROP TABLE IF EXISTS `hashing`;
CREATE TABLE IF NOT EXISTS `hashing` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `algorithm` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `original` text NOT NULL,
  `opposite` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `json`
--

DROP TABLE IF EXISTS `json`;
CREATE TABLE IF NOT EXISTS `json` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `Input` text NOT NULL,
  `errorCount` int NOT NULL,
  `errors` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `json`
--

INSERT INTO `json` (`TransactionID`, `username`, `date`, `Input`, `errorCount`, `errors`) VALUES
(1, 'weeyee', '2024-11-13', 'hi', 1, 'Syntax error');

-- --------------------------------------------------------

--
-- Table structure for table `jwt`
--

DROP TABLE IF EXISTS `jwt`;
CREATE TABLE IF NOT EXISTS `jwt` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `encoded` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `decoded` json NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mdtohtml`
--

DROP TABLE IF EXISTS `mdtohtml`;
CREATE TABLE IF NOT EXISTS `mdtohtml` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `markdown` varchar(100) NOT NULL,
  `html` varchar(100) NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mdtohtml`
--

INSERT INTO `mdtohtml` (`TransactionID`, `username`, `markdown`, `html`) VALUES
(1, 'weeyee', 'hi', '<p>hi</p>'),
(2, 'weeyee', 'hi', '<p>hi</p>');

-- --------------------------------------------------------

--
-- Table structure for table `paragraphtoone`
--

DROP TABLE IF EXISTS `paragraphtoone`;
CREATE TABLE IF NOT EXISTS `paragraphtoone` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paragraphtoone`
--

INSERT INTO `paragraphtoone` (`TransactionID`, `Username`, `Date`) VALUES
(1, 'weeyee', '2024-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `timestampconverter`
--

DROP TABLE IF EXISTS `timestampconverter`;
CREATE TABLE IF NOT EXISTS `timestampconverter` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
CREATE TABLE IF NOT EXISTS `tools` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `toolname` varchar(40) NOT NULL,
  `toolurl` varchar(40) NOT NULL,
  PRIMARY KEY (`TransactionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Fname` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Lname` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DateJoined` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `Fname`, `Lname`, `password`, `DateJoined`) VALUES
('sarahann', 'sarah', 'ann', '$2y$10$aRM4tehfh4Q.gDoPsYsrv.Y2/CXtCwzU0l2U9j9PyDLVOVUqylOeC', '2024-10-21'),
('weeyee', 'wee', 'yee', '$2y$10$ev6HCpg66bJm0BVGXOFPQOvip6UnTXs5B4v4ePPyobWe/WqOr7Rui', '2024-11-07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
