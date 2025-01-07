-- ****************************************************************
-- Doel: Opvragen van records uit de tabel
--       Users
-- ************************************************
-- Versie:    Datum:            Auteur:              Details
-- *******    ******            *******              ******* 
-- 01         29-11-2024        Daniel van Grol       SP voor read
-- ****************************************************************     


-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllUsersInfo;

CREATE PROCEDURE spGetAllUsersInfo()
BEGIN
    SELECT 
        id,
        persoon_id,
        rol_id,
        voornaam,
        tussenvoegsel,
        achternaam,
        email,
        email_verified_at,
        Isingelogd,
        Ingelogd,
        Uitgelogd,
        IsActive,
        created_at, 
        updated_at
    FROM users;
END;