DROP PROCEDURE IF EXISTS spDeleteMedewerker;

CREATE PROCEDURE spDeleteMedewerker(IN id INT UNSIGNED)
BEGIN
    DECLARE persoonId INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Er is een fout opgetreden, de bewerking is teruggedraaid en de opgeslagen procedure is beëindigd' AS Foutmelding;
    END;

    START TRANSACTION;

    SELECT PersoonId INTO persoonId
    FROM medewerkers
    WHERE Id = id;

    DELETE FROM medewerkers
    WHERE Id = id;

    DELETE FROM personen
    WHERE Id = persoonId;

    COMMIT;
END;
