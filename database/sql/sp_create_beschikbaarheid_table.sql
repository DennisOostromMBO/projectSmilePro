DROP PROCEDURE IF EXISTS create_beschikbaarheid_table;

CREATE PROCEDURE create_beschikbaarheid_table()
BEGIN
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
END;

CALL create_beschikbaarheid_table;

DROP VIEW IF EXISTS beschikbaarheid_view;

CREATE VIEW beschikbaarheid_view AS
SELECT 
    b.Id,
    b.MedewerkerId,
    CONCAT(p.Voornaam, ' ', IFNULL(p.Tussenvoegsel, ''), ' ', p.Achternaam) AS MedewerkerNaam,
    b.DatumVanaf,
    b.DatumTotMet,
    b.TijdVanaf,
    b.TijdTotMet,
    b.Status,
    b.IsActief,
    b.Opmerking,
    b.DatumAangemaakt,
    b.DatumGewijzigd
FROM 
    beschikbaarheid b
JOIN 
    medewerkers m ON b.MedewerkerId = m.Id
JOIN 
    persoon p ON m.PersoonId = p.Id;