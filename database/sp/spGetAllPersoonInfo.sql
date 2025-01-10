-- ****************************************************************
-- Doel: Opvragen van records uit de tabel
--       Persoon
-- ************************************************
-- Versie:    Datum:            Auteur:              Details
-- *******    ******            *******              ******* 
-- 01         29-11-2024        Daniel van Grol       SP voor read
-- ****************************************************************     


-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllPersoonInfo;

CREATE PROCEDURE spGetAllPersoonInfo()
BEGIN
    SELECT 
        VolledigeNaam, 
        Geboortedatum,
        IsActive, 
        Comments, 
        created_at, 
        updated_at
    FROM persoon;
END;