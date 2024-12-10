DROP PROCEDURE IF EXISTS create_beschikbaarheid_table;

CREATE PROCEDURE create_beschikbaarheid_table()
BEGIN
    CREATE TABLE IF NOT EXISTS beschikbaarheid(
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        MedewerkerId INT UNSIGNED NOT NULL UNIQUE,
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