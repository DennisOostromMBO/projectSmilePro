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
-- Tabelstructuur voor tabel `factuur`
--

DROP TABLE IF EXISTS `factuur`;
CREATE TABLE IF NOT EXISTS `factuur` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `persoonId` int UNSIGNED NOT NULL,
  `beschrijving` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vervaldatum` date NOT NULL,
  `btw` decimal(5,2) NOT NULL,
  `totaal_bedrag` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factuur_persoonid_foreign` (`persoonId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (`id`, `persoonId`, `beschrijving`, `vervaldatum`, `btw`, `totaal_bedrag`, `created_at`, `updated_at`) VALUES
(1, 201, 'Tandheelkundige controle en reiniging', '2025-02-15', '9.00', '75.00', '2025-01-10 08:00:00', '2025-01-10 08:00:00'),
(2, 202, 'Wortelkanaalbehandeling', '2025-03-01', '21.00', '350.00', '2025-01-10 08:30:00', '2025-01-10 08:30:00'),
(3, 203, 'Vulling van kies', '2025-02-25', '21.00', '125.00', '2025-01-10 09:00:00', '2025-01-10 09:00:00'),
(4, 204, 'Extractie van verstandskies', '2025-03-10', '21.00', '200.00', '2025-01-10 09:30:00', '2025-01-21 08:28:07');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD CONSTRAINT `factuur_persoonid_foreign` FOREIGN KEY (`persoonId`) REFERENCES `personen` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
