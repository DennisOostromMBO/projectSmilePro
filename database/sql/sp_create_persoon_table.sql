CREATE PROCEDURE IF NOT EXISTS create_persoon_table()
BEGIN
    CREATE TABLE IF NOT EXISTS personen (
        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Voornaam VARCHAR(100) NOT NULL,
        Tussenvoegsel VARCHAR(50) NULL,
        Achternaam VARCHAR(100) NOT NULL,
        VolledigeNaam VARCHAR(150) AS (CONCAT(Voornaam, ' ', IFNULL(Tussenvoegsel, ''), ' ', Achternaam)) STORED,
        Geboortedatum DATE NOT NULL,
        IsActive BIT NOT NULL DEFAULT 1,
        Comments VARCHAR(255) NULL,
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
END;
