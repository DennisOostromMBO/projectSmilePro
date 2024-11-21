-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 21 nov 2024 om 11:29
-- Serverversie: 9.0.1
-- PHP-versie: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smilepro`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afsprakenbeheer`
--

DROP TABLE IF EXISTS `afsprakenbeheer`;
CREATE TABLE IF NOT EXISTS `afsprakenbeheer` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `PatiëntId` int NOT NULL,
  `MedewerkerId` int NOT NULL,
  `Datum` date NOT NULL,
  `Tijd` time NOT NULL,
  `Status` enum('Bevestigd','Geannuleerd') NOT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `Comments` text,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `PatiëntId` (`PatiëntId`),
  KEY `MedewerkerId` (`MedewerkerId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
