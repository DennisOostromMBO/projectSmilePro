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
END;


-- **********debug code stored procedure***************
--  CALL spGetAllPatientInfo();
-- ****************************************************
