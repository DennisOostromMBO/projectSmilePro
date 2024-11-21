DROP PROCEDURE IF EXISTS create_afsprakenbeheer_table;

CREATE PROCEDURE create_afsprakenbeheer_table()
BEGIN
    CREATE TABLE IF NOT EXISTS afsprakenbeheer (
        Id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PatientId BIGINT UNSIGNED NOT NULL,
        MedewerkerId BIGINT UNSIGNED NOT NULL,
        Datum DATE NOT NULL,
        Tijd TIME NOT NULL,
        Status ENUM('Bevestigd', 'Geannuleerd') NOT NULL,
        IsActief BIT DEFAULT 1,  
        Opmerking VARCHAR(255) NULL,  
        DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
END;
