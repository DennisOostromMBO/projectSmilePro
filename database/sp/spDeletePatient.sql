DROP PROCEDURE IF EXISTS spDeletePatient;
 
CREATE PROCEDURE spDeletePatient(IN id INT UNSIGNED)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Er is een fout opgetreden, de bewerking is teruggedraaid en de opgeslagen procedure is beëindigd';
    END;
 
    START TRANSACTION;
 
    DELETE CONT
    FROM Contact AS CONT
    WHERE CONT.PatientId = id;
 
    DELETE PAT
    FROM Patient AS PAT
    WHERE PAT.Id = id;
 
    DELETE PERS
    FROM Persoon AS PERS
    WHERE PERS.Id = (
        SELECT PersoonId
        FROM Patient
        WHERE Id = id
    )
    AND NOT EXISTS (
        SELECT 1
        FROM Patient
        WHERE PersoonId = (
            SELECT PersoonId
            FROM Patient
            WHERE Id = id
        )
    );
 
    COMMIT;
END;
