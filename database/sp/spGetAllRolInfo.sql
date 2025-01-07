-- ****************************************************************
-- Doel: Opvragen van records uit de tabel
--       Rol
-- ************************************************
-- Versie:    Datum:            Auteur:              Details
-- *******    ******            *******              ******* 
-- 01         29-11-2024        Daniel van Grol       SP voor read
-- ****************************************************************     


-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllRolInfo;

CREATE PROCEDURE spGetAllRolInfo()
BEGIN
    SELECT 
        id,
        naam,
        beschrijving,
        created_at, 
        updated_at
    FROM rol;
END;