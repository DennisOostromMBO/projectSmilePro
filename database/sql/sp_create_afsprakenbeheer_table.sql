DROP PROCEDURE IF EXISTS create_afsprakenbeheer_table;

CREATE PROCEDURE create_afsprakenbeheer_table()
BEGIN
    CREATE TABLE IF NOT EXISTS afsprakenbeheer (
        Id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        PatiëntId BIGINT UNSIGNED NOT NULL,
        MedewerkerId BIGINT UNSIGNED NOT NULL,
        Datum DATE NOT NULL,
        Tijd TIME NOT NULL,
        Status ENUM('Bevestigd', 'Geannuleerd') NOT NULL,
        IsActive BIT DEFAULT 1,
        Comments TEXT NULL,
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (PatiëntId) REFERENCES patients(id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (MedewerkerId) REFERENCES employees(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB;
END;
