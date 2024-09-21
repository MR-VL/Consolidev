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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hashing`
--
ALTER TABLE `hashing`
  ADD CONSTRAINT `hashing_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
