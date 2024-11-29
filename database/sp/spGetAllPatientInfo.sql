DROP PROCEDURE IF EXISTS spGetAllPatientInfo;

CREATE PROCEDURE spGetAllPatientInfo()
BEGIN
    SELECT 
        p.VolledigeNaam, 
        c.VolledigAdres, 
        c.Mobiel AS Mobielnummer, 
        c.Email, 
        pa.Nummer, 
        pa.MedischDossier
    FROM patient pa
    INNER JOIN persoon p ON pa.PersoonId = p.Id
    INNER JOIN contact c ON pa.Id = c.PatientId
    WHERE pa.IsActive = 1 AND c.IsActief = 1;
END;
