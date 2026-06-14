-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2026 at 02:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

CREATE TABLE `api_requests` (
                                `TransactionID` int(11) NOT NULL,
                                `username` varchar(20) NOT NULL,
                                `date` date NOT NULL,
                                `url` varchar(2048) NOT NULL,
                                `method` enum('GET','POST','PUT','DELETE') NOT NULL,
                                `headers` text DEFAULT NULL,
                                `body` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
                             `username` varchar(20) NOT NULL,
                             `date` datetime NOT NULL,
                             `error_message` longtext NOT NULL,
                             `IPAddress` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base64`
--

CREATE TABLE `base64` (
                          `TransactionID` int(11) NOT NULL,
                          `username` varchar(20) NOT NULL,
                          `date` date NOT NULL,
                          `type` varchar(6) NOT NULL,
                          `original` text NOT NULL,
                          `opposite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caseconverter`
--

CREATE TABLE `caseconverter` (
                                 `TransactionID` int(11) NOT NULL,
                                 `username` varchar(20) NOT NULL,
                                 `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `differencechecker`
--

CREATE TABLE `differencechecker` (
                                     `TransactionID` int(11) NOT NULL,
                                     `username` varchar(20) NOT NULL,
                                     `date` date NOT NULL,
                                     `differencesFound` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `duplicatefinder`
--

CREATE TABLE `duplicatefinder` (
                                   `TransactionID` int(11) NOT NULL,
                                   `username` varchar(20) NOT NULL,
                                   `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
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
                             `TimeStampConverter` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hashing`
--

CREATE TABLE `hashing` (
                           `TransactionID` int(11) NOT NULL,
                           `username` varchar(20) NOT NULL,
                           `date` date NOT NULL,
                           `algorithm` varchar(10) NOT NULL,
                           `original` text NOT NULL,
                           `opposite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `json`
--

CREATE TABLE `json` (
                        `TransactionID` int(11) NOT NULL,
                        `username` varchar(20) NOT NULL,
                        `date` date NOT NULL,
                        `Input` text NOT NULL,
                        `errorCount` int(11) NOT NULL,
                        `errors` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jwt`
--

CREATE TABLE `jwt` (
                       `TransactionID` int(11) NOT NULL,
                       `username` varchar(20) NOT NULL,
                       `date` date NOT NULL,
                       `encoded` text NOT NULL,
                       `decoded` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`decoded`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `markdowntohtml`
--

CREATE TABLE `markdowntohtml` (
                                  `TransactionID` int(11) NOT NULL,
                                  `username` varchar(20) NOT NULL,
                                  `date` date NOT NULL,
                                  `markdown` text NOT NULL,
                                  `html` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paragraphtoone`
--

CREATE TABLE `paragraphtoone` (
                                  `TransactionID` int(11) NOT NULL,
                                  `Username` varchar(20) NOT NULL,
                                  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timestampconverter`
--

CREATE TABLE `timestampconverter` (
                                      `TransactionID` int(11) NOT NULL,
                                      `Username` varchar(20) NOT NULL,
                                      `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
                         `toolname` varchar(40) NOT NULL,
                         `toolurl` varchar(40) NOT NULL
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
                        `IPAddress` varchar(45) NOT NULL,
                        `Role` enum('Admin','User','Diamond','Moderator') NOT NULL DEFAULT 'User',
                        `Class` enum('Base','Diamond','Lifetime','') NOT NULL DEFAULT 'Base'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `Fname`, `Lname`, `password`, `DateJoined`, `IPAddress`, `Role`, `Class`) VALUES
                                                                                                              ('admin', 'admin', 'admin', '$2y$10$AqfWnn2KCCLGz41UxwRDEeTuVoYkfztlHz/praIUo9TKWfX7JMvmG', '2026-06-11', '', 'User', 'Base');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_requests`
--
ALTER TABLE `api_requests`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `base64`
--
ALTER TABLE `base64`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `caseconverter`
--
ALTER TABLE `caseconverter`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `differencechecker`
--
ALTER TABLE `differencechecker`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `duplicatefinder`
--
ALTER TABLE `duplicatefinder`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
    ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `hashing`
--
ALTER TABLE `hashing`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `json`
--
ALTER TABLE `json`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `jwt`
--
ALTER TABLE `jwt`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `markdowntohtml`
--
ALTER TABLE `markdowntohtml`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `paragraphtoone`
--
ALTER TABLE `paragraphtoone`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `timestampconverter`
--
ALTER TABLE `timestampconverter`
    ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
    ADD PRIMARY KEY (`toolname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_requests`
--
ALTER TABLE `api_requests`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base64`
--
ALTER TABLE `base64`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caseconverter`
--
ALTER TABLE `caseconverter`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `differencechecker`
--
ALTER TABLE `differencechecker`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duplicatefinder`
--
ALTER TABLE `duplicatefinder`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hashing`
--
ALTER TABLE `hashing`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `json`
--
ALTER TABLE `json`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jwt`
--
ALTER TABLE `jwt`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `markdowntohtml`
--
ALTER TABLE `markdowntohtml`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paragraphtoone`
--
ALTER TABLE `paragraphtoone`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timestampconverter`
--
ALTER TABLE `timestampconverter`
    MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;