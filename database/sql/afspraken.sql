-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 22 jan 2025 om 12:16
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
-- Tabelstructuur voor tabel `afspraken`
--

DROP TABLE IF EXISTS `afspraken`;
CREATE TABLE IF NOT EXISTS `afspraken` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `gebruiker_id` bigint UNSIGNED DEFAULT NULL,
  `patient_naam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medewerker_naam` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `type_afspraak` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `afspraken`
--

INSERT INTO `afspraken` (`id`, `gebruiker_id`, `patient_naam`, `medewerker_naam`, `datum`, `tijd`, `type_afspraak`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kerem Akturkoglu', 'Dr. Pietersen', '2025-01-22', '12:30:00', 'Controle', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(2, 2, 'Piet Pietersen', 'Dr. Jansen', '2025-01-22', '12:00:00', 'Controle', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(3, 3, 'Fatih Kuzu', 'Mvr. Lima', '2025-01-22', '13:00:00', 'Overleg', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(4, 3, 'Baris Alper Yilmaz', 'Mvr. Lima', '2025-01-30', '12:30:00', 'Overleg', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(5, 4, 'Mauro Icardi', 'Mvr. Cabrella', '2025-01-27', '10:30:00', 'Overleg', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(6, 4, 'Mauro Icardi', 'Mvr. Cabrella', '2025-02-22', '13:10:00', 'Overleg', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(7, 11, 'Fernando Muslera', 'Mvr. Astima', '2025-01-23', '08:00:00', 'Reparatie', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(8, 4, 'Victor Osimhen', 'Mvr. Helena', '2025-01-22', '15:00:00', 'Controle', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(9, 8, 'Emelia Hansen', 'Mvr. Cabrella', '2025-01-26', '08:30:00', 'Controle', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(10, 7, 'Noah Levi', 'Mvr. Lima', '2025-01-28', '10:30:00', 'Controle', '2025-01-22 12:13:34', '2025-01-22 12:13:34'),
(11, 9, 'Lucas Fischer', 'Dr. Jansen', '2025-01-28', '09:00:00', 'Controle', '2025-01-22 12:13:34', '2025-01-22 12:13:34');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
