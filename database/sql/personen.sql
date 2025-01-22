-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 21 jan 2025 om 11:37
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
-- Tabelstructuur voor tabel `personen`
--

use smilepro;

DROP TABLE IF EXISTS `personen`;
CREATE TABLE IF NOT EXISTS `personen` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Voornaam` varchar(100) NOT NULL,
  `Tussenvoegsel` varchar(50) DEFAULT NULL,
  `Achternaam` varchar(100) NOT NULL,
  `Geboortedatum` date NOT NULL,
  `IsActive` bit(1) DEFAULT b'1',
  `Comments` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `personen`
--

INSERT INTO `personen` (`Id`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Geboortedatum`, `IsActive`, `Comments`, `CreatedAt`, `UpdatedAt`) VALUES
(201, 'Jan', NULL, 'Jansen', '1980-05-15', b'1', 'Frequent bezoeker', '2025-01-10 07:00:00', '2025-01-10 07:00:00'),
(202, 'Piet', NULL, 'Pieters', '1975-03-22', b'1', 'Geen bijzonderheden', '2025-01-10 07:10:00', '2025-01-10 07:10:00'),
(203, 'Anna', 'de', 'Vries', '1990-07-30', b'1', 'Noodbehandeling aangevraagd', '2025-01-10 07:20:00', '2025-01-10 07:20:00'),
(204, 'Karin', 'van', 'Dijk', '1988-11-11', b'1', 'Nieuwe patiënt', '2025-01-10 07:30:00', '2025-01-10 07:30:00'),
(205, 'Mark', NULL, 'Bakker', '1985-01-05', b'1', 'Controle ingepland', '2025-01-10 07:40:00', '2025-01-10 07:40:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
