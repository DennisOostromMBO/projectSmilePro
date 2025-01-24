-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 22 jan 2025 om 11:58
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

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `create_afsprakenbeheer_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_afsprakenbeheer_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS afsprakenbeheer (
        Id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PatientId BIGINT UNSIGNED NOT NULL,
        MedewerkerId BIGINT UNSIGNED NOT NULL,
        Datum DATE NOT NULL,
        Tijd TIME NOT NULL,
        Status ENUM('Bevestigd', 'Geannuleerd') NOT NULL,
        IsActief BIT DEFAULT 1,
        Opmerking VARCHAR(255) NULL,
        DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
END$$

DROP PROCEDURE IF EXISTS `create_beschikbaarheid_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_beschikbaarheid_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS beschikbaarheid(
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        MedewerkerId INT UNSIGNED NOT NULL,
        DatumVanaf DATE NOT NULL,
        DatumTotMet DATE NOT NULL,
        TijdVanaf TIME NOT NULL,
        TijdTotMet TIME NOT NULL,
        Status ENUM('Aanwezig', 'Afwezig', 'Verlof', 'Ziek') NOT NULL,
        IsActief BIT DEFAULT 1,
        Opmerking VARCHAR(255) NULL,
        DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (MedewerkerId) REFERENCES medewerkers(Id) ON DELETE CASCADE
    ) ENGINE=InnoDB;
END$$

DROP PROCEDURE IF EXISTS `create_contacten_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_contacten_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS contact (
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PatientId INT UNSIGNED NOT NULL,
        Straatnaam VARCHAR(255) NOT NULL,
        Huisnummer SMALLINT NOT NULL,
        Toevoeging VARCHAR(10) NULL,
        Postcode VARCHAR(10) NOT NULL,
        Plaats VARCHAR(100) NOT NULL,
        VolledigAdres VARCHAR(255) AS (CONCAT(Straatnaam, ' ', Huisnummer,  IF(Toevoeging IS NOT NULL AND Toevoeging != '', CONCAT('-', Toevoeging), ''),  ', ', Postcode, ' ',   Plaats  )) STORED,
        Mobiel VARCHAR(20) NOT NULL,
        Email VARCHAR(255) NOT NULL,
        IsActief BIT NOT NULL DEFAULT 1,
        Opmerking VARCHAR(255) NULL,
        DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
END$$

DROP PROCEDURE IF EXISTS `create_gebruiker_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_gebruiker_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS gebruiker (
        Id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PersoonId BIGINT UNSIGNED NOT NULL,
        Gebruikersnaam VARCHAR(255) NOT NULL,
        Wachtwoord VARCHAR(255) NOT NULL,
        Isingelogd BIT NOT NULL,
        Ingelogd  BIT NOT NULL,
        Uitgelogd BIT NOT NULL,
        IsActive BIT DEFAULT 1,
        Comments VARCHAR(255) NULL,
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (PersoonId) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB;
END$$

DROP PROCEDURE IF EXISTS `create_medewerker_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_medewerker_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS medewerkers (
        Id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PersoonId BIGINT UNSIGNED NOT NULL,
        Nummer VARCHAR(255) NOT NULL,
        Medewerkertype VARCHAR(255) NOT NULL,
        Specialisatie VARCHAR(255) NOT NULL,
        Beschikbaarheid VARCHAR(255) NOT NULL,
        IsActive BIT DEFAULT 1,
        Comments VARCHAR(255) NULL,
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (PersoonId) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB;
END$$

DROP PROCEDURE IF EXISTS `create_patient_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_patient_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS patienten (
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        ,PersoonId INT UNSIGNED NULL
        ,Nummer VARCHAR(255) NOT NULL
        ,MedischDossier TEXT NULL
        ,IsActive BIT DEFAULT 1
        ,Comments VARCHAR(255) NULL
        ,CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ,UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
END$$

DROP PROCEDURE IF EXISTS `create_persoon_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_persoon_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS personen (
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Voornaam VARCHAR(100) NOT NULL,
        Tussenvoegsel VARCHAR(50) NULL,
        Achternaam VARCHAR(100) NOT NULL,
        Geboortedatum DATE NOT NULL,
        IsActive BIT DEFAULT 1,
        Comments VARCHAR(255) NULL,
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
END$$

DROP PROCEDURE IF EXISTS `create_rol_table`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_rol_table` ()   BEGIN
    CREATE TABLE IF NOT EXISTS rol (
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Naam VARCHAR(255) NOT NULL,
        IsActive BIT DEFAULT 1,
        Comments VARCHAR(255) NULL,
        Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Updated_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
END$$

DROP PROCEDURE IF EXISTS `spGetAllPatientInfo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetAllPatientInfo` ()   BEGIN
    SELECT
        PERS.VolledigeNaam,
        PERS.Geboortedatum,
        CASE
            WHEN TIMESTAMPDIFF(YEAR, PERS.Geboortedatum, CURDATE()) <= 1 THEN 'Baby'
            WHEN TIMESTAMPDIFF(YEAR, PERS.Geboortedatum, CURDATE()) BETWEEN 2 AND 3 THEN 'Peuter'
            WHEN TIMESTAMPDIFF(YEAR, PERS.Geboortedatum, CURDATE()) BETWEEN 4 AND 6 THEN 'Kleuter'
            WHEN TIMESTAMPDIFF(YEAR, PERS.Geboortedatum, CURDATE()) BETWEEN 7 AND 12 THEN 'Kind'
            WHEN TIMESTAMPDIFF(YEAR, PERS.Geboortedatum, CURDATE()) BETWEEN 13 AND 18 THEN 'Tiener'
            WHEN TIMESTAMPDIFF(YEAR, PERS.Geboortedatum, CURDATE()) BETWEEN 19 AND 64 THEN 'Volwassene'
            ELSE 'Oudere'
        END AS LeeftijdCategorie,
        CONT.VolledigAdres,
        CONT.Mobiel AS Mobielnummer,
        CONT.Email,
        PATI.Nummer,
        PATI.MedischDossier
    FROM patient AS PATI
    INNER JOIN persoon AS PERS ON PATI.PersoonId = PERS.Id
    INNER JOIN contact AS CONT ON PATI.Id = CONT.PatientId
    ORDER BY PATI.Nummer ASC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur`
--

DROP TABLE IF EXISTS `factuur`;
CREATE TABLE IF NOT EXISTS `factuur` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `persoonId` int UNSIGNED NOT NULL,
  `beschrijving` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vervaldatum` date NOT NULL,
  `btw` decimal(5,2) NOT NULL,
  `totaal_bedrag` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factuur_persoonid_foreign` (`persoonId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (`id`, `persoonId`, `beschrijving`, `vervaldatum`, `btw`, `totaal_bedrag`, `created_at`, `updated_at`) VALUES
(1, 201, 'Tandheelkundige controle en reiniging', '2025-02-15', '9.00', '75.00', '2025-01-10 08:00:00', '2025-01-10 08:00:00'),
(2, 202, 'Wortelkanaalbehandeling', '2025-03-01', '21.00', '350.00', '2025-01-10 08:30:00', '2025-01-10 08:30:00'),
(3, 203, 'Vulling van kies', '2025-02-25', '21.00', '125.00', '2025-01-10 09:00:00', '2025-01-10 09:00:00'),
(4, 204, 'Extractie van verstandskies', '2025-03-10', '21.00', '200.00', '2025-01-10 09:30:00', '2025-01-21 08:28:07');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

DROP TABLE IF EXISTS `gebruiker`;
CREATE TABLE IF NOT EXISTS `gebruiker` (
  `Id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `PersoonId` bigint UNSIGNED NOT NULL,
  `Gebruikersnaam` varchar(255) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL,
  `Isingelogd` bit(1) NOT NULL,
  `Ingelogd` bit(1) NOT NULL,
  `Uitgelogd` bit(1) NOT NULL,
  `IsActive` bit(1) DEFAULT b'1',
  `Comments` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `PersoonId` (`PersoonId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

DROP TABLE IF EXISTS `medewerkers`;
CREATE TABLE IF NOT EXISTS `medewerkers` (
  `Id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `PersoonId` bigint UNSIGNED NOT NULL,
  `Nummer` varchar(255) NOT NULL,
  `Medewerkertype` varchar(255) NOT NULL,
  `Specialisatie` varchar(255) NOT NULL,
  `Beschikbaarheid` varchar(255) NOT NULL,
  `IsActive` bit(1) DEFAULT b'1',
  `Comments` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `PersoonId` (`PersoonId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_20_120311_create_medewerkers_table', 1),
(5, '2024_11_20_122420_create_patients_table', 1),
(6, '2024_11_20_131335_create_personen_table', 1),
(7, '2024_11_21_110227_create__gebruiker_table', 1),
(8, '2024_11_21_110236_create__rol_table', 1),
(9, '2024_11_21_111344_create_factuurs_table', 1),
(10, '0001_01_01_000000_create__rol_table', 2),
(11, '0001_01_01_000000_create_persoon_table', 2),
(12, '0001_01_01_000001_create_users_table', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `patienten`
--

DROP TABLE IF EXISTS `patienten`;
CREATE TABLE IF NOT EXISTS `patienten` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `PersoonId` int UNSIGNED DEFAULT NULL,
  `Nummer` varchar(255) NOT NULL,
  `MedischDossier` text,
  `IsActive` bit(1) DEFAULT b'1',
  `Comments` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personen`
--

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `persoon`
--

DROP TABLE IF EXISTS `persoon`;
CREATE TABLE IF NOT EXISTS `persoon` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Voornaam` varchar(100) NOT NULL,
  `Tussenvoegsel` varchar(50) DEFAULT NULL,
  `Achternaam` varchar(100) NOT NULL,
  `VolledigeNaam` varchar(150) GENERATED ALWAYS AS (concat(`Voornaam`,_utf8mb4' ',ifnull(`Tussenvoegsel`,_utf8mb4''),_utf8mb4' ',`Achternaam`)) STORED,
  `Geboortedatum` date NOT NULL,
  `IsActive` bit(1) DEFAULT b'1',
  `Comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `persoon`
--

INSERT INTO `persoon` (`id`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Geboortedatum`, `IsActive`, `Comments`, `created_at`, `updated_at`) VALUES
(1, 'Wassim', NULL, 'Bachtour', '2010-05-12', b'1', NULL, '2025-01-22 10:19:22', '2025-01-22 10:19:22'),
(2, 'Wassim', NULL, 'Bachtour', '2010-05-12', b'1', NULL, '2025-01-22 10:19:27', '2025-01-22 10:19:27'),
(3, 'Wassim', NULL, 'Bachtour', '2010-05-12', b'1', NULL, '2025-01-22 10:20:18', '2025-01-22 10:20:18'),
(4, 'Wassim', NULL, 'Bachtour', '2010-05-12', b'1', NULL, '2025-01-22 10:34:56', '2025-01-22 10:34:56'),
(5, 'Wassim', NULL, 'Bachtour', '2010-05-12', b'1', NULL, '2025-01-22 10:47:26', '2025-01-22 10:47:26'),
(6, 'Wassim', NULL, 'Bachtour', '2010-05-12', b'1', NULL, '2025-01-22 10:55:25', '2025-01-22 10:55:25'),
(7, 'Wassim', NULL, 'A', '2010-05-12', b'1', NULL, '2025-01-22 11:56:44', '2025-01-22 11:56:44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `Id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `GebruikerId` bigint UNSIGNED NOT NULL,
  `Naam` varchar(255) NOT NULL,
  `IsActive` bit(1) DEFAULT b'1',
  `Comments` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `GebruikerId` (`GebruikerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `persoon_id` int UNSIGNED DEFAULT NULL,
  `rol_id` bigint UNSIGNED NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `tussenvoegsel` varchar(255) DEFAULT NULL,
  `achternaam` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `Isingelogd` bit(1) DEFAULT b'0',
  `Ingelogd` timestamp NULL DEFAULT NULL,
  `Uitgelogd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `IsActive` bit(1) DEFAULT b'1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` varchar(255) DEFAULT NULL,
  `VolledigeNaam` varchar(255) GENERATED ALWAYS AS (concat(`voornaam`,_utf8mb4' ',ifnull(`tussenvoegsel`,_utf8mb4''),_utf8mb4' ',`achternaam`)) STORED,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `persoon_id` (`persoon_id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD CONSTRAINT `factuur_persoonid_foreign` FOREIGN KEY (`persoonId`) REFERENCES `personen` (`Id`);

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`persoon_id`) REFERENCES `persoon` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
