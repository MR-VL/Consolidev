-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 23, 2024 at 12:48 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `hashing`
--

DROP TABLE IF EXISTS `hashing`;
CREATE TABLE IF NOT EXISTS `hashing` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `algorithm` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `original` text NOT NULL,
  `opposite` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hashing`
--

INSERT INTO `hashing` (`TransactionID`, `username`, `algorithm`, `original`, `opposite`) VALUES
(1, 'test', 'md2', 'test', 'dd34716876364a02d0195e2fb9ae2d1b'),
(2, 'test', 'md4', 'woof', '149c823487111a85ab1323cf05ad15f4'),
(3, 'test', 'md5', 'meow', '4a4be40c96ac6314e91d93f38043a634'),
(4, 'test', 'sha1', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(5, 'test', 'sha256', 'testingg', '604c3f3b6a400261c5476461a815b1bb4b8927c4ad7dd1b31150e6beff5af9fe'),
(6, 'test', 'sha512', 'password', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86'),
(7, 'test', 'ripemd128', 'test', 'f1abb5083c9ff8a9dbbca9cd2b11fead'),
(8, 'test', 'ripemd256', 'testg', '63bfa2bd52827194fc29837c6e4bcacb1bf28c80840e9788d6b2a94513365024'),
(9, 'test', 'whirlpool', 'whirlpool', '0d680e5e4832d76f6930b14a2098c6a2c31017ebb2dbaedcf07a3d43eaefaf9b663ad79083ee3436e5f3a8d60d046d5c7ee7d986d727e94bbedfd0d085507fed'),
(10, 'test', 'snefru', 'crc344', '4343eb97185454ad85318b2e29bfaa821219f57e51dd943c52bb0178e88f5074'),
(11, 'test', 'crc32', 'crc32', '6add5dc6'),
(12, 'test', 'adler32', 'adler', '05fa0209');

-- --------------------------------------------------------

--
-- Table structure for table `json`
--

DROP TABLE IF EXISTS `json`;
CREATE TABLE IF NOT EXISTS `json` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `Input` text NOT NULL,
  `errorCount` int NOT NULL,
  `errors` text NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jwt`
--

DROP TABLE IF EXISTS `jwt`;
CREATE TABLE IF NOT EXISTS `jwt` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `encoded` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `decoded` json NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jwt`
--

INSERT INTO `jwt` (`TransactionID`, `username`, `encoded`, `decoded`) VALUES
(11, 'test', 'eyJhbGciOiJIUzI1NiIsInppcCI6IkdaSVAifQ.eJxtjk0OgjAQhe8yaxALAsJVjIsCA1ahbToFNcS7OxAxMXE53_uZNwONFZQgm0FpCMCbG-rQPy0usK6RKFwZa7pqoRRpnCaZKLJDAIqIXZGRo7_E0WbrnBktC6dP6ZlbZRcq7dFp2UM5s0Vqv32xkuhuXMNR60yr-gUOZlJIjCZ0pIxmJHZ7vkdaWgb8bn4FgA-7DUvydZj0v0uvXnGgyOoqyQvRHrMU40T8rXsDw0VUkw.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"error\": \"Decoding Error: JSON decoding error: Syntax error\"}'),
(12, 'test', 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJhZG1pbiIsInRva2VuLXR5cGUiOiJhY2Nlc3MtdG9rZW4iLCJuYmYiOjE1MjUzNjE5NjQsImlzcyI6Ii9vYXV0aDIvdG9rZW4iLCJncm91cHMiOlsiYWRtaW4iXSwidGFnLWludGVybmFsIjp7ImdyYW50LXR5cGUiOiJwYXNzd29yZCIsInByb2ZpbGUiOiJtb3ZpZXMiLCJ2ZXJzaW9uIjoiMS4wIiwidXNlcm5hbWUiOiJhZG1pbiJ9LCJleHAiOjE1MjUzNjM3NjQsImlhdCI6MTUyNTM2MTk2NCwianRpIjoiOTZjYjM3OTFmODY1ZTIzMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"exp\": 1525363764, \"iat\": 1525361964, \"iss\": \"/oauth2/token\", \"jti\": \"96cb3791f865e231\", \"nbf\": 1525361964, \"sub\": \"admin\", \"groups\": [\"admin\"], \"username\": \"admin\", \"token-type\": \"access-token\", \"tag-internal\": {\"profile\": \"movies\", \"version\": \"1.0\", \"username\": \"admin\", \"grant-type\": \"password\"}}'),
(13, 'test', 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJhZG1pbiIsInRva2VuLXR5cGUiOiJhY2Nlc3MtdG9rZW4iLCJuYmYiOjE1MjUzNjE5NjQsImlzcyI6Ii9vYXV0aDIvdG9rZW4iLCJncm91cHMiOlsiYWRtaW4iXSwidGFnLWludGVybmFsIjp7ImdyYW50LXR5cGUiOiJwYXNzd29yZCIsInByb2ZpbGUiOiJtb3ZpZXMiLCJ2ZXJzaW9uIjoiMS4wIiwidXNlcm5hbWUiOiJhZG1pbiJ9LCJleHAiOjE1MjUzNjM3NjQsImlhdCI6MTUyNTM2MTk2NCwianRpIjoiOTZjYjM3OTFmODY1ZTIzMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"exp\": 1525363764, \"iat\": 1525361964, \"iss\": \"/oauth2/token\", \"jti\": \"96cb3791f865e231\", \"nbf\": 1525361964, \"sub\": \"admin\", \"groups\": [\"admin\"], \"username\": \"admin\", \"token-type\": \"access-token\", \"tag-internal\": {\"profile\": \"movies\", \"version\": \"1.0\", \"username\": \"admin\", \"grant-type\": \"password\"}}'),
(14, 'test', 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJhZG1pbiIsInRva2VuLXR5cGUiOiJhY2Nlc3MtdG9rZW4iLCJuYmYiOjE1MjUzNjE5NjQsImlzcyI6Ii9vYXV0aDIvdG9rZW4iLCJncm91cHMiOlsiYWRtaW4iXSwidGFnLWludGVybmFsIjp7ImdyYW50LXR5cGUiOiJwYXNzd29yZCIsInByb2ZpbGUiOiJtb3ZpZXMiLCJ2ZXJzaW9uIjoiMS4wIiwidXNlcm5hbWUiOiJhZG1pbiJ9LCJleHAiOjE1MjUzNjM3NjQsImlhdCI6MTUyNTM2MTk2NCwianRpIjoiOTZjYjM3OTFmODY1ZTIzMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"exp\": 1525363764, \"iat\": 1525361964, \"iss\": \"/oauth2/token\", \"jti\": \"96cb3791f865e231\", \"nbf\": 1525361964, \"sub\": \"admin\", \"groups\": [\"admin\"], \"username\": \"admin\", \"token-type\": \"access-token\", \"tag-internal\": {\"profile\": \"movies\", \"version\": \"1.0\", \"username\": \"admin\", \"grant-type\": \"password\"}}'),
(15, 'test', 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJhZG1pbiIsInRva2VuLXR5cGUiOiJhY2Nlc3MtdG9rZW4iLCJuYmYiOjE1MjUzNjE5NjQsImlzcyI6Ii9vYXV0aDIvdG9rZW4iLCJncm91cHMiOlsiYWRtaW4iXSwidGFnLWludGVybmFsIjp7ImdyYW50LXR5cGUiOiJwYXNzd29yZCIsInByb2ZpbGUiOiJtb3ZpZXMiLCJ2ZXJzaW9uIjoiMS4wIiwidXNlcm5hbWUiOiJhZG1pbiJ9LCJleHAiOjE1MjUzNjM3NjQsImlhdCI6MTUyNTM2MTk2NCwianRpIjoiOTZjYjM3OTFmODY1ZTIzMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"exp\": 1525363764, \"iat\": 1525361964, \"iss\": \"/oauth2/token\", \"jti\": \"96cb3791f865e231\", \"nbf\": 1525361964, \"sub\": \"admin\", \"groups\": [\"admin\"], \"username\": \"admin\", \"token-type\": \"access-token\", \"tag-internal\": {\"profile\": \"movies\", \"version\": \"1.0\", \"username\": \"admin\", \"grant-type\": \"password\"}}'),
(16, 'test', 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJhZG1pbiIsInRva2VuLXR5cGUiOiJhY2Nlc3MtdG9rZW4iLCJuYmYiOjE1MjUzNjE5NjQsImlzcyI6Ii9vYXV0aDIvdG9rZW4iLCJncm91cHMiOlsiYWRtaW4iXSwidGFnLWludGVybmFsIjp7ImdyYW50LXR5cGUiOiJwYXNzd29yZCIsInByb2ZpbGUiOiJtb3ZpZXMiLCJ2ZXJzaW9uIjoiMS4wIiwidXNlcm5hbWUiOiJhZG1pbiJ9LCJleHAiOjE1MjUzNjM3NjQsImlhdCI6MTUyNTM2MTk2NCwianRpIjoiOTZjYjM3OTFmODY1ZTIzMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"exp\": 1525363764, \"iat\": 1525361964, \"iss\": \"/oauth2/token\", \"jti\": \"96cb3791f865e231\", \"nbf\": 1525361964, \"sub\": \"admin\", \"groups\": [\"admin\"], \"username\": \"admin\", \"token-type\": \"access-token\", \"tag-internal\": {\"profile\": \"movies\", \"version\": \"1.0\", \"username\": \"admin\", \"grant-type\": \"password\"}}'),
(17, 'test', 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJhZG1pbiIsInRva2VuLXR5cGUiOiJhY2Nlc3MtdG9rZW4iLCJuYmYiOjE1MjUzNjE5NjQsImlzcyI6Ii9vYXV0aDIvdG9rZW4iLCJncm91cHMiOlsiYWRtaW4iXSwidGFnLWludGVybmFsIjp7ImdyYW50LXR5cGUiOiJwYXNzd29yZCIsInByb2ZpbGUiOiJtb3ZpZXMiLCJ2ZXJzaW9uIjoiMS4wIiwidXNlcm5hbWUiOiJhZG1pbiJ9LCJleHAiOjE1MjUzNjM3NjQsImlhdCI6MTUyNTM2MTk2NCwianRpIjoiOTZjYjM3OTFmODY1ZTIzMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"exp\": 1525363764, \"iat\": 1525361964, \"iss\": \"/oauth2/token\", \"jti\": \"96cb3791f865e231\", \"nbf\": 1525361964, \"sub\": \"admin\", \"groups\": [\"admin\"], \"username\": \"admin\", \"token-type\": \"access-token\", \"tag-internal\": {\"profile\": \"movies\", \"version\": \"1.0\", \"username\": \"admin\", \"grant-type\": \"password\"}}'),
(18, 'test', 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJhZG1pbiIsInRva2VuLXR5cGUiOiJhY2Nlc3MtdG9rZW4iLCJuYmYiOjE1MjUzNjE5NjQsImlzcyI6Ii9vYXV0aDIvdG9rZW4iLCJncm91cHMiOlsiYWRtaW4iXSwidGFnLWludGVybmFsIjp7ImdyYW50LXR5cGUiOiJwYXNzd29yZCIsInByb2ZpbGUiOiJtb3ZpZXMiLCJ2ZXJzaW9uIjoiMS4wIiwidXNlcm5hbWUiOiJhZG1pbiJ9LCJleHAiOjE1MjUzNjM3NjQsImlhdCI6MTUyNTM2MTk2NCwianRpIjoiOTZjYjM3OTFmODY1ZTIzMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.zOEUjH6Q3PtYI16WgpF7xM1jlHDM8gbD9mRNgYxOKgI', '{\"exp\": 1525363764, \"iat\": 1525361964, \"iss\": \"/oauth2/token\", \"jti\": \"96cb3791f865e231\", \"nbf\": 1525361964, \"sub\": \"admin\", \"groups\": [\"admin\"], \"username\": \"admin\", \"token-type\": \"access-token\", \"tag-internal\": {\"profile\": \"movies\", \"version\": \"1.0\", \"username\": \"admin\", \"grant-type\": \"password\"}}');

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
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `Fname`, `Lname`, `password`) VALUES
('test', 'Test', 'Test', '$2y$10$l.LJQnOcdpdH50X2hTYUu.c2QjMKqmZbZw461VYr6sHw0/RLLNQGC');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `base64`
--
ALTER TABLE `base64`
  ADD CONSTRAINT `base64_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `hashing`
--
ALTER TABLE `hashing`
  ADD CONSTRAINT `hashing_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `json`
--
ALTER TABLE `json`
  ADD CONSTRAINT `json_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `jwt`
--
ALTER TABLE `jwt`
  ADD CONSTRAINT `jwt_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
