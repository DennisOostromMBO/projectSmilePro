-- ****************************************************************
-- Doel: Opvragen van records uit de tabel
--       Gebruiker, Persoon en Contact
-- ************************************************
-- Versie:    Datum:            Auteur:              Details
-- *******    ******            *******              ******* 
-- 01         13-12-2024        Daniel van Grol       SP voor read
-- ****************************************************************     

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllGebruikersInfo;

CREATE PROCEDURE spGetAllGebruikersInfo()
BEGIN
    SELECT 
        GEBR.name AS Gebruikersnaam,
        GEBR.Email,
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
        CONT.Email AS ContactEmail
    FROM gebruiker AS GEBR
    INNER JOIN persoon AS PERS ON GEBR.PersoonId = PERS.Id
    INNER JOIN contact AS CONT ON PERS.Id = CONT.PersoonId
    ORDER BY GEBR.name ASC; 
END;

-- **********debug code stored procedure***************
--  CALL spGetAllGebruikersInfo();
-- ****************************************************