-- ****************************************************************
-- Doel: Opvragen van records uit de tabel
--       Patient, Contact en Persoon
-- ************************************************
-- Versie:    Datum:            Auteur:              Details
-- *******    ******            *******              ******* 
-- 01         29-11-2024        Dennis Oostrom       SP voor read
-- ****************************************************************     


-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllPatientInfo;

CREATE PROCEDURE spGetAllPatientInfo()
BEGIN
    SELECT 
        PERS.VolledigeNaam, 
        CONT.VolledigAdres, 
        CONT.Mobiel AS Mobielnummer, 
        CONT.Email, 
        PATI.Nummer, 
        PATI.MedischDossier
    FROM patient AS PATI
    INNER JOIN persoon AS PERS ON PATI.PersoonId = PERS.Id
    INNER JOIN contact AS CONT ON PATI.Id = CONT.PatientId
    ORDER BY PATI.Nummer ASC; 
END;

-- **********debug code stored procedure***************
--  CALL spGetAllPatientInfo();
-- ****************************************************
