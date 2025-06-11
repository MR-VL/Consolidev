-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2024 at 01:41 AM
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
-- database: `consolidev`
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
  `url` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` enum('GET','POST','PUT','DELETE') NOT NULL,
  `headers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body` text,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opposite` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `duplicatefinder`
--

DROP TABLE IF EXISTS `duplicatefinder`;
CREATE TABLE IF NOT EXISTS `duplicatefinder` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `APIRequestBuilder` tinyint(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `Base64` tinyint(1) NOT NULL,
  `CaseConverter` tinyint(1) NOT NULL,
  `DifferenceChecker` tinyint(1) NOT NULL,
  `DuplicateChecker` tinyint(1) NOT NULL,
  `Hashing` tinyint(1) NOT NULL,
  `JSONValidator` tinyint(1) NOT NULL,
  `JWTDecode` tinyint(1) NOT NULL,
  `MarkdownToHtmlConverter` tinyint(1) NOT NULL,
  `ParagraphtoOneLineConverter` tinyint(1) NOT NULL,
  `TimeStampConverter` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hashing`
--

DROP TABLE IF EXISTS `hashing`;
CREATE TABLE IF NOT EXISTS `hashing` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `algorithm` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `original` text NOT NULL,
  `opposite` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `json`
--

DROP TABLE IF EXISTS `json`;
CREATE TABLE IF NOT EXISTS `json` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `Input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `errorCount` int NOT NULL,
  `errors` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jwt`
--

DROP TABLE IF EXISTS `jwt`;
CREATE TABLE IF NOT EXISTS `jwt` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `encoded` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `decoded` json NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `markdowntohtml`
--

DROP TABLE IF EXISTS `markdowntohtml`;
CREATE TABLE IF NOT EXISTS `markdowntohtml` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `markdown` text NOT NULL,
  `html` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
CREATE TABLE IF NOT EXISTS `tools` (
  `toolname` varchar(40) NOT NULL,
  `toolurl` varchar(40) NOT NULL,
  PRIMARY KEY (`toolname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`toolname`, `toolurl`) VALUES
('APIRequestBuilder', 'apirequestbuilder.php'),
('Base64', 'base64.php'),
('CaseConverter', 'caseconverter.php'),
('DifferenceChecker', 'differencechecker.php'),
('DuplicateChecker', 'duplicates.php'),
('Hashing', 'hashing.php'),
('JSONValidator', 'Json.php'),
('JWTDecode', 'jwt.php'),
('MarkdownToHtmlConverter', 'markdowntohtml.php'),
('ParagraphtoOneLineConverter', 'paragraphtooneline.php'),
('TimeStampConverter', 'timestampconverter.php');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
    `username` varchar(20) NOT NULL,
    `Fname` varchar(15) NOT NULL,
    `Lname` varchar(15) NOT NULL,
    `password` varchar(60) NOT NULL,
    `DateJoined` date NOT NULL,
    `Premium Status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Free plan\r\n1: Premium plan\r\n',
    `Account Status` int(1) NOT NULL DEFAULT 3 COMMENT '1: Enabled\r\n2: Disabled\r\n3: Restricted\r\n4: Minor\r\n5: Trial'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
